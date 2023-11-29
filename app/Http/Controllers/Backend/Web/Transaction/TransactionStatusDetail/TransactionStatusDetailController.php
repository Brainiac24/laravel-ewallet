<?php
/**
 * Created by PhpStorm.
 * User: F_Kosimov
 * Date: 18.07.2018
 * Time: 14:31
 */

namespace App\Http\Controllers\Backend\Web\Transaction\TransactionStatusDetail;

use App\Events\Backend\User\UserHistory\UserModifiedEvent;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Web\Transaction\TransactionStatusDetail\StoreTransactionStatusDetailRequest;
use App\Http\Requests\Backend\Web\Transaction\TransactionStatusDetail\UpdateTransactionDetailStatusRequest;
use App\Repositories\Backend\Transaction\TransactionStatusDetail\TransactionStatusDetailRepositoryContract;
use App\Services\Common\Helpers\Events;
use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;

class TransactionStatusDetailController extends Controller
{
    protected $transactionStatusDetailRepository;

    public function __construct(TransactionStatusDetailRepositoryContract $transactionStatusDetailRepository)
    {
        $this->transactionStatusDetailRepository = $transactionStatusDetailRepository;
        $this->middleware('transaction.status.detail.can-list');
    }

    public function index()
    {
        $transactionStatusDetails = $this->transactionStatusDetailRepository->all();
        return view('backend.transaction.transactionStatusDetail.index',compact('transactionStatusDetails'));
    }

    public function create()
    {
        return view('backend.transaction.transactionStatusDetail.create');
    }

    public function edit($id)
    {
        $transactionStatusDetail = $this->transactionStatusDetailRepository->findById($id);
        Breadcrumbs::setCurrentRoute('admin.transactions.status.edit', $transactionStatusDetail);
        return view('backend.transaction.transactionStatusDetail.edit',compact('transactionStatusDetail'));
    }

    public function show($id)
    {
        $transactionStatusDetail = $this->transactionStatusDetailRepository->findById($id);
        Breadcrumbs::setCurrentRoute('admin.transactions.status.show', $transactionStatusDetail);
        return view('backend.transaction.transactionStatusDetail.show',compact('transactionStatusDetail'));
    }
    public function destroy($id)
    {
        try {
            $transactionStatusDetail = $this->transactionStatusDetailRepository->destroy($id);
            event(new UserModifiedEvent($transactionStatusDetail, Events::DELETED));
            session()->flash('flash_message', trans('alerts.general.success_delete'));
            return redirect()->route('admin.transactions.status-detail.index');
        } catch (\Exception $e) {
            session()->flash('flash_message_error', trans('errorMessages.errors.try_errors.' . $e->getCode()));
            return redirect()->route('admin.transactions.status-detail.index');
        }
    }
    public function store(StoreTransactionStatusDetailRequest $request)
    {
        $transactionStatusDetail = $this->transactionStatusDetailRepository->create($request->validated());
        $transactionStatusDetail->setChanges($transactionStatusDetail->getAttributes());
        event(new UserModifiedEvent($transactionStatusDetail, Events::CREATED));
        session()->flash('flash_message', trans('alerts.general.success_add'));
        return redirect()->route('admin.transactions.status-detail.index');
    }

    public function update(UpdateTransactionDetailStatusRequest $request, $id)
    {
        $transactionStatusDetail = $this->transactionStatusDetailRepository->update($request->validated(), $id);
        event(new UserModifiedEvent($transactionStatusDetail, Events::UPDATED));
        session()->flash('flash_message', trans('alerts.general.success_edit'));
        return redirect()->route('admin.transactions.status-detail.index');
    }
}