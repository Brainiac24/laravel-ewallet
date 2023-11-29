<?php


namespace App\Http\Controllers\Backend\Web\Transaction\TransactionContinueRule;


use App\Events\Backend\User\UserHistory\UserModifiedEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Web\Transaction\TransactionContinueRule\IndexTransactionContinueRule;
use App\Http\Requests\Backend\Web\Transaction\TransactionContinueRule\StoreTransactionContinueRuleRequest;
use App\Http\Requests\Backend\Web\Transaction\TransactionContinueRule\UpdateTransactionContinueRuleRequest;
use App\Repositories\Backend\Gateway\GatewayRepositoryContract;
use App\Repositories\Backend\Transaction\TransactionContinueRule\TransactionContinueRuleRepositoryContract;
use App\Repositories\Backend\Transaction\TransactionContinueRuleAccordance\TransactionContinueRuleAccordanceRepositoryContract;
use App\Repositories\Backend\Transaction\TransactionStatus\TransactionStatusRepositoryContract;
use App\Repositories\Backend\Transaction\TransactionSyncStatus\TransactionSyncStatusRepositoryContract;
use App\Repositories\Backend\User\UserRepositoryContract;
use App\Services\Common\Gateway\Identification\identificationContract;
use App\Services\Common\Helpers\Events;

class TransactionContinueRuleController extends Controller
{

    private $transactionContinueRuleRepository;
    private $transactionContinueRuleAccordanceRepository;
    private $gatewayRepository;
    private $transactionSyncStatusRepository;
    private $transactionStatusRepository;
    private $userRepository;

    public function __construct(
        TransactionContinueRuleRepositoryContract $transactionContinueRuleRepository,
        TransactionContinueRuleAccordanceRepositoryContract $transactionContinueRuleAccordanceRepository,
        TransactionStatusRepositoryContract $transactionStatusRepository,
        TransactionSyncStatusRepositoryContract $transactionSyncStatusRepository,
        GatewayRepositoryContract $gatewayRepository,
        UserRepositoryContract $userRepository
    )
    {
        $this->transactionContinueRuleRepository=$transactionContinueRuleRepository;
        $this->transactionContinueRuleAccordanceRepository=$transactionContinueRuleAccordanceRepository;
        $this->gatewayRepository=$gatewayRepository;
        $this->transactionStatusRepository=$transactionStatusRepository;
        $this->transactionSyncStatusRepository=$transactionSyncStatusRepository;
        $this->userRepository = $userRepository;
        $this->middleware('transaction.continueRule.can-list', ['only' => ['index']]);
        $this->middleware('transaction.continueRule.can-show', ['only' => ['show']]);
        $this->middleware('transaction.continueRule.can-create', ['only' => ['create','store']]);
        $this->middleware('transaction.continueRule.can-edit', ['only' => ['edit','update']]);
        $this->middleware('transaction.continueRule.can-delete', ['only' => ['destroy']]);
    }

    public function index(IndexTransactionContinueRule $request)
    {
        $data = $request->validated();
        $transactionContinueRules = $this->transactionContinueRuleRepository->paginate($data);
        $filterGateways=$this->gatewayRepository->all()->pluck('name','id')->toArray();
        $filterTransactionStatus=$this->transactionStatusRepository->all()->pluck('name','id')->toArray();
        $filterTransactionSyncStatus=$this->transactionSyncStatusRepository->all()->pluck('name','id')->toArray();

        return view('backend.transaction.transactionContinueRule.index',
            compact('transactionContinueRules', 'filterTransactionStatus', 'filterGateways', 'filterTransactionSyncStatus', 'data'));
    }

    public function show($id)
    {
        $transactionContinueRule = $this->transactionContinueRuleRepository->findById($id);
        $transactionContinueRuleAccordances=$this->transactionContinueRuleAccordanceRepository->getAllByTransactionContinueRuleId($id);
        \Breadcrumbs::setCurrentRoute('admin.transactions.continueRules.show',$transactionContinueRule);
        return view('backend.transaction.transactionContinueRule.show',compact('transactionContinueRule', 'transactionContinueRuleAccordances'));

    }

    public function create()
    {
        $gateways=$this->gatewayRepository->all()->pluck('name','id')->toArray();
        $transactionStatus=$this->transactionStatusRepository->all()->pluck('name','id')->toArray();
        $transactionSyncStatus=$this->transactionSyncStatusRepository->all()->pluck('name','id')->prepend('', '')->toArray();

        return view('backend.transaction.transactionContinueRule.create', compact( 'transactionStatus', 'gateways', 'transactionSyncStatus'));
    }

    public function edit($id)
    {
        $transactionContinueRule = $this->transactionContinueRuleRepository->findById($id);
        $gateways=$this->gatewayRepository->all()->pluck('name','id')->toArray();
        $transactionStatus=$this->transactionStatusRepository->all()->pluck('name','id')->toArray();
        $transactionSyncStatus=$this->transactionSyncStatusRepository->all()->pluck('name','id')->prepend('', '')->toArray();
        $transactionContinueRuleAccordances = $this->transactionContinueRuleAccordanceRepository->getAllListByTransactionContinueRuleId($id);
        $users = $this->userRepository->listAllIsAdmin();
        \Breadcrumbs::setCurrentRoute('admin.transactions.continueRules.edit',$transactionContinueRule);
        return view('backend.transaction.transactionContinueRule.edit',
            compact('transactionContinueRule','transactionStatus', 'gateways', 'transactionSyncStatus', 'users', 'transactionContinueRuleAccordances'));
    }

    public function store(StoreTransactionContinueRuleRequest $request)
    {
        $transactionContinueRule= $this->transactionContinueRuleRepository->create($request->validated());
        $transactionContinueRule->setChanges($transactionContinueRule->getAttributes());
        event(new UserModifiedEvent($transactionContinueRule, Events::CREATED));
        session()->flash('flash_message', trans('alerts.general.success_add'));
        return redirect()->route('admin.transactions.continueRules.show', $transactionContinueRule->id);
    }

    public function update(UpdateTransactionContinueRuleRequest $request, $id)
    {
        $transactionContinueRule=$this->transactionContinueRuleRepository->update($request->validated(), $id);
        $allowedUsers = $request->get('allowed_users', []);
        $this->transactionContinueRuleAccordanceRepository->setAllowedUsersTransactionContinueRule($id, $allowedUsers);
        event(new UserModifiedEvent($transactionContinueRule, Events::UPDATED));
        session()->flash('flash_message', trans('alerts.general.success_edit'));
        return redirect()->route('admin.transactions.continueRules.show', $transactionContinueRule->id);
    }

    public function destroy($id)
    {
        try{
            $transactionContinueRule = $this->transactionContinueRuleRepository->destroy($id);
            event(new UserModifiedEvent($transactionContinueRule, Events::DELETED));
            session()->flash('flash_message', trans('alerts.general.success_delete'));
            return redirect()->route('admin.transactions.continueRules.index');
        }catch (\Exception $e) {
            session()->flash('flash_message_error', trans('errorMessages.errors.try_errors.' . $e->getCode()));
            return redirect()->route('admin.transactions.continueRules.index');
        }
    }
}