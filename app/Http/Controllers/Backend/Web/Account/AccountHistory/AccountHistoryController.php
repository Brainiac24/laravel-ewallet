<?php
/**
 * Created by PhpStorm.
 * User: F_Kosimov
 * Date: 18.07.2018
 * Time: 14:31
 */

namespace App\Http\Controllers\Backend\Web\Account\AccountHistory;

use App\Events\Frontend\User\UserHistory\UserModifiedEvent;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Web\Account\Account\StoreAccountHistoryRequest;
use App\Http\Requests\Backend\Web\Account\Account\UpdateAccountHistoryRequest;
use App\Repositories\Backend\Account\AccountHistory\AccountHistoryRepositoryContract;
use App\Services\Common\Helpers\Events;
use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;

class AccountHistoryController extends Controller
{
    protected $accountHistoryRepository;

    public function __construct(AccountHistoryRepositoryContract  $accountHistoryRepository)
    {
        $this->accountHistoryRepository = $accountHistoryRepository;
        $this->middleware('account.history.can-list', ['only' => ['index']]);
        $this->middleware('account.history.can-show', ['only' => ['show']]);
        $this->middleware('account.history.can-create', ['only' => ['create','store']]);
        $this->middleware('account.history.can-edit', ['only' => ['edit','update']]);
        $this->middleware('account.history.can-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $accountHistory = $this->accountHistoryRepository->paginate();
        return view('backend.account.accountHistory.index',compact('accountHistory'));
    }

    public function create()
    {
        return view('backend.account.accountHistory.create');
    }

    public function edit($id)
    {

        $accountHistory = $this->accountHistoryRepository->findById($id);
        Breadcrumbs::setCurrentRoute('admin.accounts.histories.edit', $accountHistory);
        return view('backend.account.accountHistory.edit' , compact('accountHistory'));
    }

    public function show($id)
    {
        $accountHistory = $this->accountHistoryRepository->findById($id);
        Breadcrumbs::setCurrentRoute('admin.accounts.histories.show', $accountHistory);
        return view('backend.account.accountHistory.show',compact('accountHistory'));
    }
    public function destroy($id)
    {
        try {
            $accountHistory = $this->accountHistoryRepository->destroy($id);
            event(new UserModifiedEvent($accountHistory, Events::DELETED));
            session()->flash('flash_message', trans('alerts.general.success_delete'));
            return redirect()->route('admin.accounts.histories.index');
        } catch (\Exception $e) {
            session()->flash('flash_message_error', trans('errorMessages.errors.try_errors.' . $e->getCode()));
            return redirect()->route('admin.accounts.histories.index');
        }
    }
    public function store(StoreAccountHistoryRequest $request)
    {
        $accountHistory = $this->accountHistoryRepository->create($request->validated());
        event(new UserModifiedEvent($accountHistory, Events::CREATED));
        session()->flash('flash_message', trans('alerts.general.success_add'));
        return redirect()->route('admin.accounts.histories.index');
    }

    public function update(UpdateAccountHistoryRequest $request, $id)
    {

        $accountHistory = $this->accountHistoryRepository->update($request->validated(), $id);
        event(new UserModifiedEvent($accountHistory, Events::UPDATED));
        session()->flash('flash_message', trans('alerts.general.success_edit'));
        return redirect()->route('admin.accounts.histories.index');
    }
}