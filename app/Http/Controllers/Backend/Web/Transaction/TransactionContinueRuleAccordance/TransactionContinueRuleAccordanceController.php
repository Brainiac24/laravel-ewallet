<?php


namespace App\Http\Controllers\Backend\Web\Transaction\TransactionContinueRuleAccordance;


use App\Events\Backend\User\UserHistory\UserModifiedEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Web\Transaction\TransactionContinueRuleAccordance\StoreTransactionContinueRuleAccordanceRequest;
use App\Http\Requests\Backend\Web\Transaction\TransactionContinueRuleAccordance\UpdateTransactionContinueRuleAccordanceRequest;
use App\Repositories\Backend\Transaction\TransactionContinueRule\TransactionContinueRuleRepositoryContract;
use App\Repositories\Backend\Transaction\TransactionContinueRuleAccordance\TransactionContinueRuleAccordanceRepositoryContract;
use App\Repositories\Backend\Transaction\TransactionStatus\TransactionStatusRepositoryContract;
use App\Repositories\Backend\Transaction\TransactionSyncStatus\TransactionSyncStatusRepositoryContract;
use App\Repositories\Backend\User\UserRepositoryContract;
use App\Services\Common\Helpers\Events;

class TransactionContinueRuleAccordanceController extends Controller
{
    private $transactionContinueRuleRepository;
    private $transactionContinueRuleAccordanceRepository;
    private $transactionSyncStatusRepository;
    private $transactionStatusRepository;
    private $userRepository;

    public function __construct(
        TransactionContinueRuleRepositoryContract $transactionContinueRuleRepository,
        TransactionContinueRuleAccordanceRepositoryContract $transactionContinueRuleAccordanceRepository,
        TransactionStatusRepositoryContract $transactionStatusRepository,
        TransactionSyncStatusRepositoryContract $transactionSyncStatusRepository,
        UserRepositoryContract $userRepository
    )
    {
        $this->transactionContinueRuleRepository=$transactionContinueRuleRepository;
        $this->transactionContinueRuleAccordanceRepository=$transactionContinueRuleAccordanceRepository;
        $this->transactionStatusRepository=$transactionStatusRepository;
        $this->transactionSyncStatusRepository=$transactionSyncStatusRepository;
        $this->userRepository=$userRepository;
        $this->middleware('transaction.continueRuleAccordance.can-list', ['only' => ['index']]);
        $this->middleware('transaction.continueRuleAccordance.can-show', ['only' => ['show']]);
        $this->middleware('transaction.continueRuleAccordance.can-create', ['only' => ['create','store']]);
        $this->middleware('transaction.continueRuleAccordance.can-edit', ['only' => ['edit','update']]);
        $this->middleware('transaction.continueRuleAccordance.can-delete', ['only' => ['destroy']]);
    }

    public function index($transactionContinueRule_id)
    {

    }

    public function show($transactionContinueRule_id, $id)
    {
        $transactionContinueRuleAccordance=$this->transactionContinueRuleAccordanceRepository->findById($id);
        $usersFullName = '';
        if (is_array($transactionContinueRuleAccordance->allowed_users)){
            $users = $this->userRepository->getByIds($transactionContinueRuleAccordance->allowed_users);
            foreach ($users as $user) {
                $usersFullName .= $user->fullNameExtendedFormat.'; ';
            }
        }
        $transactionContinueRule=$this->transactionContinueRuleRepository->findById($transactionContinueRule_id);
        \Breadcrumbs::setCurrentRoute('admin.transactions.continueRules.accordance.show',$transactionContinueRule, $id);
        return view('backend.transaction.transactionContinueRuleAccordance.show',compact('transactionContinueRuleAccordance', 'usersFullName'));
    }

    public function edit($transactionContinueRule_id, $id)
    {
        $transactionContinueRule=$this->transactionContinueRuleRepository->findById($transactionContinueRule_id);
        $transactionContinueRuleAccordance=$this->transactionContinueRuleAccordanceRepository->findById($id);
        $transactionStatus=$this->transactionStatusRepository->getTransactionStatusesRule()->pluck('name','id')->toArray();
        $transactionSyncStatus=$this->transactionSyncStatusRepository->all()->pluck('name','id')->toArray();
        \Breadcrumbs::setCurrentRoute('admin.transactions.continueRules.accordance.edit',$transactionContinueRule, $id);
        return view('backend.transaction.transactionContinueRuleAccordance.edit',
            compact('transactionContinueRuleAccordance', 'transactionSyncStatus', 'transactionStatus','transactionContinueRule'));
    }

    public function create($transactionContinueRule_id)
    {
        $transactionContinueRule=$this->transactionContinueRuleRepository->findById($transactionContinueRule_id);
        $transactionStatus=$this->transactionStatusRepository->getTransactionStatusesRule()->pluck('name','id')->toArray();
        $transactionSyncStatus=$this->transactionSyncStatusRepository->all()->pluck('name','id')->toArray();
        \Breadcrumbs::setCurrentRoute('admin.transactions.continueRules.accordance.create',$transactionContinueRule);
        return view('backend.transaction.transactionContinueRuleAccordance.create',
            compact('transactionSyncStatus', 'transactionStatus','transactionContinueRule'));
    }

    public function store(StoreTransactionContinueRuleAccordanceRequest $request, $transactionContinueRule_id)
    {
        $transactionContinueRuleAccordance = $this->transactionContinueRuleAccordanceRepository->create($request->validated());
        $transactionContinueRuleAccordance->setChanges($transactionContinueRuleAccordance->getAttributes());
        event(new UserModifiedEvent($transactionContinueRuleAccordance, Events::CREATED));
        session()->flash('flash_message', trans('alerts.general.success_add'));
        return redirect()->route('admin.transactions.continueRules.show',$transactionContinueRule_id);
    }

    public function update(UpdateTransactionContinueRuleAccordanceRequest $request, $transactionContinueRule_id, $id)
    {
        $transactionContinueRuleAccordance=$this->transactionContinueRuleAccordanceRepository->update($request->validated(), $id);
        event(new UserModifiedEvent($transactionContinueRuleAccordance, Events::UPDATED));
        session()->flash('flash_message', trans('alerts.general.success_edit'));
        return redirect()->route('admin.transactions.continueRules.show',$transactionContinueRule_id);
    }

    public function destroy($transactionContinueRule_id, $id)
    {
        try{
            $transactionContinueRuleAccordance = $this->transactionContinueRuleAccordanceRepository->destroy($id);
            event(new UserModifiedEvent($transactionContinueRuleAccordance, Events::DELETED));
            session()->flash('flash_message', trans('alerts.general.success_delete'));
            return redirect()->route('admin.transactions.continueRules.show',$transactionContinueRule_id);
        }catch (\Exception $e) {
            session()->flash('flash_message_error', trans('errorMessages.errors.try_errors.' . $e->getCode()));
            return redirect()->route('admin.transactions.continueRules.show',$transactionContinueRule_id);
        }
    }
}