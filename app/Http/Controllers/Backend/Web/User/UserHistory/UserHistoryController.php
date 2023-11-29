<?php

namespace App\Http\Controllers\Backend\Web\User\UserHistory;

use App\Http\Requests\Backend\Web\User\UserHistory\StoreUserHistoryRequest;
use App\Http\Requests\Backend\Web\User\UserHistory\UpdateUserHistoryRequest;
use App\Repositories\Backend\User\UserHistory\UserHistoryRepositoryContract;
use App\Http\Controllers\Controller;
use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;

class UserHistoryController extends Controller
{
    protected $userHistoryRepository;

    public function __construct(UserHistoryRepositoryContract $userHistoryRepository)
    {
        $this->userHistoryRepository = $userHistoryRepository;
        $this->middleware('user.history.can-list', ['only' => ['index']]);
        $this->middleware('user.history.can-show', ['only' => ['show']]);

    }

    public function index()
    {
        $userHistories = $this->userHistoryRepository->paginate();
        return view('backend.user.history.index',compact('userHistories'));
    }

    public function create()
    {
        return view('backend.user.history.create');
    }

    public function edit($id)
    {
        $userHistory = $this->userHistoryRepository->findById($id);
        Breadcrumbs::setCurrentRoute('admin.users.histories.edit', $userHistory);
        return view('backend.user.history.edit',compact('userHistory'));
    }

    public function show($id)
    {
        $userHistory = $this->userHistoryRepository->findById($id);
        Breadcrumbs::setCurrentRoute('admin.users.histories.show', $userHistory);
        return view('backend.user.history.show',compact('userHistory'));
    }
    public function destroy($id)
    {
        try {
            $this->userHistoryRepository->destroy($id);
            session()->flash('flash_message', trans('alerts.general.success_delete'));
            return redirect()->route('admin.users.histories.index');
        } catch (\Exception $e) {
            session()->flash('flash_message_error', trans('errorMessages.errors.try_errors.' . $e->getCode()));
            return redirect()->route('admin.users.histories.index');
        }
    }
    public function store(StoreUserHistoryRequest $request)
    {
        $this->userHistoryRepository->create($request->validated());
        session()->flash('flash_message', trans('alerts.general.success_add'));
        return redirect()->route('admin.users.histories.index');
    }

    public function update(UpdateUserHistoryRequest $request, $id)
    {
        $this->userHistoryRepository->update($request->validated(), $id);
        session()->flash('flash_message', trans('alerts.general.success_edit'));
        return redirect()->route('admin.users.histories.index');
    }
}
