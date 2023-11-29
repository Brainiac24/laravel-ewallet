<?php
/**
 * Created by PhpStorm.
 * User: F_Kosimov
 * Date: 18.07.2018
 * Time: 14:31
 */

namespace App\Http\Controllers\Backend\Web\Transaction\TransactionHistory;

use App\Events\Backend\User\UserHistory\UserModifiedEvent;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Web\Transaction\TransactionHistory\StoreTransactionHistoryRequest;
use App\Http\Requests\Backend\Web\Transaction\TransactionHistory\UpdateTransactionHistoryRequest;
use App\Repositories\Backend\Transaction\TransactionHistory\TransactionHistoryRepositoryContract;
use App\Services\Common\Helpers\Events;
use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;

class TransactionHistoryController extends Controller
{
    protected $transactionHistoryRepository;

    public function __construct(TransactionHistoryRepositoryContract $transactionHistoryRepository)
    {
        $this->transactionHistoryRepository = $transactionHistoryRepository;
        $this->middleware('transaction.history.can-list', ['only' => ['index']]);
        $this->middleware('transaction.history.can-show', ['only' => ['show']]);
        $this->middleware('transaction.history.can-create', ['only' => ['create','store']]);
        $this->middleware('transaction.history.can-edit', ['only' => ['edit','update']]);
        $this->middleware('transaction.history.can-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $transactionHistories = $this->transactionHistoryRepository->paginate();
        return view('backend.transaction.transactionHistory.index',compact('transactionHistories'));
    }

    public function create()
    {
        return view('backend.transaction.transactionHistory.create');
    }

    public function edit($id)
    {
        $transactionHistory = $this->transactionHistoryRepository->findById($id);
        Breadcrumbs::setCurrentRoute('admin.transactions.histories.edit', $transactionHistory);
        return view('backend.transaction.transactionHistory.edit',compact('transactionHistory'));
    }

    public function show($id)
    {
        $transactionHistory = $this->transactionHistoryRepository->findById($id);
        Breadcrumbs::setCurrentRoute('admin.transactions.histories.show', $transactionHistory);
        return view('backend.transaction.transactionHistory.show',compact('transactionHistory'));
    }
    public function destroy($id)
    {
        try {
            $transactionHistory = $this->transactionHistoryRepository->destroy($id);
            event(new UserModifiedEvent($transactionHistory, Events::DELETED));
            session()->flash('flash_message', trans('alerts.general.success_delete'));
            return redirect()->route('admin.transactions.histories.index');
        } catch (\Exception $e) {
            session()->flash('flash_message_error', trans('errorMessages.errors.try_errors.' . $e->getCode()));
            return redirect()->route('admin.transactions.histories.index');
        }
    }
    public function store(StoreTransactionHistoryRequest $request)
    {
        $transactionHistory = $this->transactionHistoryRepository->create($request->validated());
        $transactionHistory->setChanges($transactionHistory->getAttributes());
        event(new UserModifiedEvent($transactionHistory, Events::CREATED));
        session()->flash('flash_message', trans('alerts.general.success_add'));
        return redirect()->route('admin.transactions.histories.index');
    }

    public function update(UpdateTransactionHistoryRequest $request, $id)
    {
        $transactionHistory = $this->transactionHistoryRepository->update($request->validated(), $id);
        event(new UserModifiedEvent($transactionHistory, Events::UPDATED));
        session()->flash('flash_message', trans('alerts.general.success_edit'));
        return redirect()->route('admin.transactions.histories.index');
    }
}