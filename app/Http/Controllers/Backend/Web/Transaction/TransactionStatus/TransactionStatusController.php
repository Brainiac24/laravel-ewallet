<?php
/**
 * Created by PhpStorm.
 * User: F_Kosimov
 * Date: 18.07.2018
 * Time: 14:31
 */

namespace App\Http\Controllers\Backend\Web\Transaction\TransactionStatus;

use App\Events\Backend\User\UserHistory\UserModifiedEvent;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Web\Transaction\TransactionStatus\StoreTransactionStatusRequest;
use App\Http\Requests\Backend\Web\Transaction\TransactionStatus\UpdateTransactionStatusRequest;
use App\Repositories\Backend\Transaction\TransactionStatus\TransactionStatusRepositoryContract;
use App\Repositories\Backend\Transaction\TransactionStatusGroup\TransactionStatusGroupRepositoryContract;
use App\Services\Common\Helpers\Events;
use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;

class TransactionStatusController extends Controller
{
    protected $transactionStatusRepository;
    protected $transactionStatusGroup;

    public function __construct(TransactionStatusRepositoryContract $transactionStatusRepository , TransactionStatusGroupRepositoryContract $transactionStatusGroup )
    {
        $this->transactionStatusRepository = $transactionStatusRepository;
        $this->transactionStatusGroup = $transactionStatusGroup;
        $this->middleware('transaction.status.can-list');
    }

    public function index()
    {
        $transactionStatuses = $this->transactionStatusRepository->all();
        return view('backend.transaction.transactionStatus.index', compact('transactionStatuses'));
    }

    public function create()
    {
        $transactionStatusGroups= $this->transactionStatusGroup->all()->pluck('name','id');
        return view('backend.transaction.transactionStatus.create',compact('transactionStatusGroups'));
    }

    public function edit($id)
    {
        $transactionStatusGroups= $this->transactionStatusGroup->all()->pluck('name','id');
        $transactionStatus = $this->transactionStatusRepository->findById($id);
        $selectedStatusGroup = $transactionStatus->transaction_status_group_id;
        Breadcrumbs::setCurrentRoute('admin.transactions.status.edit', $transactionStatus);
        return view('backend.transaction.transactionStatus.edit', compact('transactionStatus','transactionStatusGroups','selectedStatusGroup'));
    }

    public function show($id)
    {
        $transactionStatus = $this->transactionStatusRepository->findById($id);
        Breadcrumbs::setCurrentRoute('admin.transactions.status.show', $transactionStatus);
        return view('backend.transaction.transactionStatus.show', compact('transactionStatus'));
    }

    public function destroy($id)
    {
        try {
            $transactionStatus = $this->transactionStatusRepository->destroy($id);
            event(new UserModifiedEvent($transactionStatus, Events::DELETED));
            session()->flash('flash_message', trans('alerts.general.success_delete'));
            return redirect()->route('admin.transactions.status.index');
        } catch (\Exception $e) {
            session()->flash('flash_message_error', trans('errorMessages.errors.try_errors.' . $e->getCode()));
            return redirect()->route('admin.transactions.status.index');
        }
    }

    public function store(StoreTransactionStatusRequest $request)
    {
        $transactionStatus = $this->transactionStatusRepository->create($request->validated());
        $transactionStatus->setChanges($transactionStatus->getAttributes());
        event(new UserModifiedEvent($transactionStatus, Events::CREATED));
        session()->flash('flash_message', trans('alerts.general.success_add'));
        return redirect()->route('admin.transactions.status.index');
    }

    public function update(UpdateTransactionStatusRequest $request, $id)
    {
        $transactionStatus = $this->transactionStatusRepository->update($request->validated(), $id);
        event(new UserModifiedEvent($transactionStatus, Events::UPDATED));
        session()->flash('flash_message', trans('alerts.general.success_edit'));
        return redirect()->route('admin.transactions.status.index');
    }
}