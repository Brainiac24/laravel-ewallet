<?php


namespace App\Http\Controllers\Backend\Web\Cashback\CashbackType;


use App\Events\Backend\User\UserHistory\UserModifiedEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Web\Cashback\CashbackType\StoreCashbackTypeRequest;
use App\Http\Requests\Backend\Web\Cashback\CashbackType\UpdateCashbackTypeRequest;
use App\Repositories\Backend\Cashback\CashbackType\CashbackTypeRepositoryContract;
use App\Services\Common\Helpers\Events;
use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;

class CashbackTypeController extends Controller
{
    private $cashbackTypeRepositoryContract;

    public function __construct(
        CashbackTypeRepositoryContract $cashbackTypeRepositoryContract
    )
    {
        $this->middleware('cashback.type.can-list', ['only' => ['index']]);
        $this->middleware('cashback.type.can-show', ['only' => ['show']]);
        $this->middleware('cashback.type.can-create', ['only' => ['create', 'store']]);
        $this->middleware('cashback.type.can-edit', ['only' => ['edit', 'update']]);
        $this->middleware('cashback.type.can-delete', ['only' => ['destroy']]);

        $this->cashbackTypeRepositoryContract=$cashbackTypeRepositoryContract;
    }

    public function index()
    {
        $cashbackTypes = $this->cashbackTypeRepositoryContract->getAll('');
        return view('backend.cashback.cashbackType.index', compact('cashbackTypes'));
    }

    public function show($id)
    {
        $data = $this->cashbackTypeRepositoryContract->findById($id);

        Breadcrumbs::setCurrentRoute('admin.cashbackTypes.show', $data);
        return view('backend.cashback.cashbackType.show', compact('data'));
    }

    public function edit($id)
    {
        $data = $this->cashbackTypeRepositoryContract->findById($id);
        Breadcrumbs::setCurrentRoute('admin.cashbackTypes.edit', $data);
        return view('backend.cashback.cashbackType.edit', compact('data'));
    }

    public function update(UpdateCashbackTypeRequest $request, $id)
    {
        $data = $this->cashbackTypeRepositoryContract->update($request->validated(), $id);
        event(new UserModifiedEvent($data, Events::UPDATED));
        session()->flash('flash_message', trans('alerts.general.success_edit'));
        return redirect()->route('admin.cashbackTypes.index');
    }

    public function create()
    {
        return view('backend.cashback.cashbackType.create');
    }

    public function store(StoreCashbackTypeRequest $request)
    {
        $data = $this->cashbackTypeRepositoryContract->create($request->validated());
        $data->setChanges($data->getAttributes());
        event(new UserModifiedEvent($data, Events::CREATED));
        session()->flash('flash_message', trans('alerts.general.success_add'));
        return redirect()->route('admin.cashbackTypes.index');
    }

    public function destroy($id)
    {
        try {
            $data = $this->cashbackTypeRepositoryContract->destroy($id);
            event(new UserModifiedEvent($data, Events::DELETED));
            session()->flash('flash_message', trans('alerts.general.success_delete'));
            return redirect()->route('admin.cashbackTypes.index');
        } catch (\Exception $e) {
            session()->flash('flash_message_error', trans('errorMessages.errors.try_errors.' . $e->getCode()));
            return redirect()->route('admin.cashbackTypes.index');
        }
    }


}