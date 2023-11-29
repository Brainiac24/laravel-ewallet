<?php
/**
 * Created by PhpStorm.
 * User: F_Kosimov
 * Date: 18.07.2018
 * Time: 14:31
 */

namespace App\Http\Controllers\Backend\Web\Transaction\TransactionType;

use App\Events\Backend\User\UserHistory\UserModifiedEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Web\Transaction\TransactionType\StoreTransactionTypeRequest;
use App\Http\Requests\Backend\Web\Transaction\TransactionType\UpdateTransactionTypeRequest;
use App\Repositories\Backend\Transaction\TransactionType\TransactionTypeRepositoryContract;
use App\Services\Common\Helpers\Events;
use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;

class TransactionTypeController extends Controller
{
    protected $transactionTypeRepository;

    public function __construct(TransactionTypeRepositoryContract $transactionTypeRepository)
    {
        $this->transactionTypeRepository = $transactionTypeRepository;
        $this->middleware('transaction.type.can-list');
    }

    public function index()
    {
        $transactionTypes = $this->transactionTypeRepository->all();
        return view('backend.transaction.transactionType.index',compact('transactionTypes'));
    }

    public function create()
    {
        return view('backend.transaction.transactionType.create');
    }

    public function edit($id)
    {
        $transactionType = $this->transactionTypeRepository->findById($id);
        Breadcrumbs::setCurrentRoute('admin.transactions.type.edit', $transactionType);
        return view('backend.transaction.transactionType.edit',compact('transactionType'));
    }

    public function show($id)
    {
        $transactionType = $this->transactionTypeRepository->findById($id);
        Breadcrumbs::setCurrentRoute('admin.transactions.type.show', $transactionType);
        return view('backend.transaction.transactionType.show',compact('transactionType'));
    }
    public function destroy($id)
    {
        try {
            $transactionType = $this->transactionTypeRepository->destroy($id);
            event(new UserModifiedEvent($transactionType, Events::DELETED));
            session()->flash('flash_message', trans('alerts.general.success_delete'));
            return redirect()->route('admin.transactions.type.index');
        } catch (\Exception $e) {
            session()->flash('flash_message_error', trans('errorMessages.errors.try_errors.' . $e->getCode()));
            return redirect()->route('admin.transactions.type.index');
        }
    }
    public function store(StoreTransactionTypeRequest $request)
    {
        $transactionType = $this->transactionTypeRepository->create($request->validated());
        $transactionType->setChanges($transactionType->getAttributes());
        event(new UserModifiedEvent($transactionType, Events::CREATED));
        session()->flash('flash_message', trans('alerts.general.success_add'));
        return redirect()->route('admin.transactions.type.index');
    }

    public function update(UpdateTransactionTypeRequest $request, $id)
    {
        $transactionType = $this->transactionTypeRepository->update($request->validated(), $id);
        event(new UserModifiedEvent($transactionType, Events::UPDATED));
        session()->flash('flash_message', trans('alerts.general.success_edit'));
        return redirect()->route('admin.transactions.type.index');
    }
}