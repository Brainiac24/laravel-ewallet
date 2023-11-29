<?php
/**
 * Created by PhpStorm.
 * User: F_Kosimov
 * Date: 27.07.2018
 * Time: 16:36
 */

namespace App\Http\Controllers\Backend\Web\Transaction;

use App\Events\Backend\User\UserHistory\UserModifiedEvent;
use App\Exports\TestExportCsv;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Web\Transaction\ChangeSyncStatusTransactionRequest;
use App\Http\Requests\Backend\Web\Transaction\EditTransactionStatusRequest;
use App\Http\Requests\Backend\Web\Transaction\IndexTransactionRequest;
use App\Http\Requests\Backend\Web\Transaction\StoreTransactionRequest;
use App\Http\Requests\Backend\Web\Transaction\UpdateTransactionRequest;
use App\Http\Resources\Backend\Web\Transaction\TransactionListResource;
use App\Jobs\TestToCsvJob;
use App\Repositories\Backend\Account\AccountRepositoryContract;
use App\Repositories\Backend\Account\AccountType\AccountTypeEloquentRepository;
use App\Repositories\Backend\Gateway\GatewayEloquentRepository;
use App\Repositories\Backend\Merchant\MerchantRepositoryContract;
use App\Repositories\Backend\Service\ServiceRepositoryContract;
use App\Repositories\Backend\Transaction\TransactionContinueRule\TransactionContinueRuleRepositoryContract;
use App\Repositories\Backend\Transaction\TransactionContinueRuleAccordance\TransactionContinueRuleAccordanceRepositoryContract;
use App\Repositories\Backend\Transaction\TransactionHistory\TransactionHistoryRepositoryContract;
use App\Repositories\Backend\Transaction\TransactionRepositoryContract;
use App\Repositories\Backend\Transaction\TransactionStatus\TransactionStatusRepositoryContract;
use App\Repositories\Backend\Transaction\TransactionStatusGroup\TransactionStatusGroupRepositoryContract;
use App\Repositories\Backend\Transaction\TransactionSyncStatus\TransactionSyncStatusRepositoryContract;
use App\Services\Backend\Web\ExportJob\TransactionExportJob\TransactionExportJobService;
use App\Services\Backend\Web\ExportJob\TransactionExportJob\TransactionExportJobServiceContract;
use App\Services\Common\Helpers\Events;
use App\Services\Common\Helpers\Service;
use App\Services\Common\Helpers\TransactionStatus;
use App\Services\Common\Helpers\TransactionStatusDetail;
use App\Services\Common\Helpers\TransactionSyncStatus;
use App\Services\Frontend\Api\Transaction\TransactionServiceContract;
use Carbon\Carbon;
use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;
use Hamcrest\Thingy;
use Illuminate\Support\Facades\Auth;
use function Symfony\Component\VarDumper\Dumper\esc;

class TransactionController extends Controller
{
    protected $transactionRepository;
    protected $transactionHistoryRepository;
    protected $serviceRepository;
    protected $transactionStatuses;
    protected $transactionService;
    protected $accountRepository;
    protected $accountTypeRepository;
    protected $gatewayRepository;
    /**
     * @var TransactionStatusGroupRepositoryContract
     */
    private $transactionStatusGroupRepository;
    /**
     * @var TransactionSyncStatusRepositoryContract
     */
    private $transactionSyncStatusRepository;

    private $transactionExportJobService;


    private $merchantRepository;

    private $transactionContinueRuleRepository;
    private $transactionContinueRuleAccordanceRepository;

    public function __construct(TransactionRepositoryContract $transactionRepository,
                                TransactionHistoryRepositoryContract $transactionHistoryRepository,
                                TransactionServiceContract $transactionService,
                                ServiceRepositoryContract $serviceRepository,
                                TransactionStatusRepositoryContract $transactionStatuses,
                                TransactionStatusGroupRepositoryContract $transactionStatusGroupRepository,
                                TransactionSyncStatusRepositoryContract $transactionSyncStatusRepository,
                                AccountRepositoryContract $accountRepositoryContract,
                                AccountTypeEloquentRepository $accountTypeEloquentRepository,
                                GatewayEloquentRepository $gatewayEloquentRepository,
                                TransactionExportJobServiceContract $transactionExportJobService,
                                MerchantRepositoryContract $merchantRepository,
                                TransactionContinueRuleRepositoryContract $transactionContinueRuleRepository,
                                TransactionContinueRuleAccordanceRepositoryContract $transactionContinueRuleAccordanceRepository
                                )
    {

        $this->transactionRepository = $transactionRepository;
        $this->transactionHistoryRepository = $transactionHistoryRepository;
        $this->serviceRepository = $serviceRepository;
        $this->transactionStatuses = $transactionStatuses;
        $this->transactionService = $transactionService;
        $this->transactionStatusGroupRepository = $transactionStatusGroupRepository;
        //$this->transactionStatusGroupRepository = $transactionStatusGroupRepository;
        $this->accountRepository = $accountRepositoryContract;
        $this->accountTypeRepository = $accountTypeEloquentRepository;
        $this->gatewayRepository = $gatewayEloquentRepository;
        $this->transactionSyncStatusRepository = $transactionSyncStatusRepository;
        $this->transactionExportJobService = $transactionExportJobService;

        $this->merchantRepository=$merchantRepository;
        $this->transactionContinueRuleAccordanceRepository=$transactionContinueRuleAccordanceRepository;
        $this->transactionContinueRuleRepository=$transactionContinueRuleRepository;


        $this->middleware('transaction.can-list', ['only' => ['index']]);
        $this->middleware('transaction.can-show', ['only' => ['show']]);
        //$this->middleware('transaction.can-create', ['only' => ['create', 'store']]);
        $this->middleware('transaction.can-edit', ['only' => ['edit', 'update', 'return']]);
        $this->middleware('transaction.can-delete', ['only' => ['destroy']]);
        $this->middleware('transaction.can-resend', ['only' => ['resend']]);
    }

    public function index(IndexTransactionRequest $request)
    {
        $data = $request->validated();
        $filterData = $data;

        if(!empty($filterData['from_gateway_id']) && !empty($filterData['to_gateway_id'])){
            //if from and receive gateways are filled use OR ... OR condition
            $filterData['from_gateway_or_to_gateway'] = ['from_gateway_id'=>$filterData['from_gateway_id'], 'to_gateway_id'=>$filterData['to_gateway_id']];
            unset($filterData['from_gateway_id']);
            unset($filterData['to_gateway_id']);

        }
        if ($request->export ?? false == true) {
            //Костыль надо думать как можно организовать через FormRequest
            if(empty($data["from_date"]) && empty($data["from_date_finish"])) {
                session()->flash('flash_message_error', 'Поле from date или from date finish обязательно для заполнения, когда export указано.');
                return redirect()->route('admin.transactions.index');
            }

            try{
                $this->transactionExportJobService->create($filterData);
                session()->flash('flash_message', "Задача для формирование отчета создано. Вы сможете найти свою выгрузку в разделе \"Задачи\"");
                return redirect()->route('admin.transactions.index');
            }catch (\Exception $e)
            {
                session()->flash('flash_message_error', $e->getMessage());
                return redirect()->route('admin.transactions.index');
            }
        } else {

            $transactions = $this->transactionRepository->paginate($filterData);
            $services = $this->serviceRepository->allPluck();
            asort($services);
            $transactionStatuses = $this->transactionStatuses->all()->pluck('name', 'id')->toArray();
            $transactionStatusGroups = $this->transactionStatusGroupRepository->all()->pluck('name', 'id')->toArray();
            $transactionSyncStatus = $this->transactionSyncStatusRepository->all()->pluck('name', 'id')->toArray();
            $gateways = $this->gatewayRepository->all()->pluck('name', 'id')->prepend('','')->toArray();
            $merchants=$this->merchantRepository->all('')->pluck('name', 'id')->toArray();

            $transactions_to_array = TransactionListResource::collection($transactions);

            $transactions->appends($data);
            return view('backend.transaction.transaction.index',
                compact('transactions', 'transactions_to_array', 'data', 'services', 'transactionStatuses',
                    'transactionStatusGroups', 'transactionSyncStatus', 'merchants', 'gateways'));
        }
    }

    public function child_index($id)
    {
        $transactions = $this->transactionRepository->getByParentId($id);

        $transactions_to_array = TransactionListResource::collection($transactions);

        return view('backend.transaction.transaction.child_index', compact('transactions_to_array'));
    }

    /*public function create()
    {

        return view('backend.transaction.transaction.create');
    }*/

    public function editChild($parent_id, $id)
    {
        return $this->edit($id);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function edit($id)
    {
        $transaction = $this->transactionRepository->findById($id);
        $from_account = $this->accountRepository->findById($transaction->from_account_id);
        $from_account_type = $this->accountTypeRepository->findById($from_account->account_type_id);
        $from_qateway_id = $from_account_type->gateway_id;

        if($transaction->to_account_id!=null){
            $to_account = $this->accountRepository->findById($transaction->to_account_id);
            $to_account_type = $this->accountTypeRepository->findById($to_account->account_type_id);
            $to_gateway_id = $to_account_type->gateway_id;
        } else {
            $service = $this->serviceRepository->findById($transaction->service_id);
            $to_gateway_id = $service->gateway_id;
        }
        $uneditable_statuses = array(
            '353914a2-b03b-11e8-904b-b06ebfbfa715' => 'Неподтверждённая транзакция',
            '6a30ce6d-bb41-11e8-92b3-b06ebfbfa715' => 'Возврат',
            '1d001ec2-867b-11e8-90c7-b06ebfbfa715' => 'Завершён',
            '28be6b80-867b-11e8-90c7-b06ebfbfa715' => 'Отказано',
        );
        $transactionStatusMessages = [];
        $statusMatrix = [];
        $transaction_status_id = $transaction->transaction_status_id;
        $transaction_sync_status_id = $transaction->transaction_sync_status_id;
        if (array_key_exists($transaction_status_id, $uneditable_statuses)) {
              //"Дать возможность редактирование поля статус синхронизации в вкладке ""Транзакции"",
              //   перед редактирование проверят статус, допускать только транзакции со статусом ""завершен""
              //  и статус_синхронизации ""Ошибка обработки шины""
            $isSyncStatusErrorBus = $transaction_status_id == TransactionStatus::COMPLETED && $transaction_sync_status_id == TransactionSyncStatus::ERROR_BUS;

            //либо вычисление кешбека для мерчанта завершилось с ошибкой
            $isCashbackCalculationError = $transaction_status_id == TransactionStatus::COMPLETED && $transaction->is_cashback_process_completed != true
                                            && $transaction->service_id == Service::MERCHANT;
            if ($isSyncStatusErrorBus) {
                $statusMatrix[TransactionStatus::COMPLETED] = array(
                    "rule" => array(TransactionStatus::COMPLETED, TransactionStatus::PAY_REJECTED),
                    "message" => array("")
                );
                $transactionStatusMessages = collect([TransactionStatus::COMPLETED => '', TransactionStatus::PAY_REJECTED =>'']);
            } else if ($isCashbackCalculationError) { // при ошибке один из процессов начисления кэшбэка
                $statusMatrix[TransactionStatus::COMPLETED] = array(
                    "rule" => array(TransactionStatus::COMPLETED),
                    "message" => array("Один из процессов начисления кэшбека выдало ошибку или не выполнялось, поэтому нужно продолжить процесс")
                );
                $transactionStatusMessages = collect([TransactionStatus::COMPLETED => 'Один из процессов начисления кэшбека выдало ошибку или не выполнялось, поэтому нужно продолжить процесс']);
            } else {
                session()->flash('flash_message_error', 'Упс! Нельзя редактировать транзакцию со статусом "' . $transaction->transaction_status->name . '"' ?? "");

                return redirect()->back();
            }
            $transactionStatuses = $this->transactionStatuses->getByStatusIds($statusMatrix[$transaction_status_id]['rule'])->pluck('name', 'id')->toArray();
            $message = $statusMatrix[$transaction_status_id]['message'][0];
            $transactionSyncStatus = $this->transactionSyncStatusRepository->all()->pluck('name', 'id')->toArray();
        } else {
            $continueRuleFilterParams = [
                'transaction_status_id' => $transaction_status_id,
                'transaction_sync_status_id' => $transaction_sync_status_id,
                'from_gateway_id' => $from_qateway_id,
                'to_gateway_id' => $to_gateway_id,
                'is_active' => 1
            ];
            $transactionContinueRule = $this->transactionContinueRuleRepository->getFirst($continueRuleFilterParams);

            if (isset($transactionContinueRule)) {

                $transactionContinueRuleAccordance = $this->transactionContinueRuleAccordanceRepository->getAllByTransactionContinueRuleId($transactionContinueRule->id);

                if (isset($transactionContinueRuleAccordance)) {

                    foreach ($transactionContinueRuleAccordance as $key => $item) {
                        $isActiveUserInAllowedUsers = is_array($item->allowed_users) &&
                            count($item->allowed_users) > 0 && !in_array(Auth::user()->id, $item->allowed_users);
                        //if user not in continue rule allowed users unset rule
                        if ($isActiveUserInAllowedUsers) {
                            unset($transactionContinueRuleAccordance[$key]);
                        }
                    }
                    $transactionStatuses = $transactionContinueRuleAccordance->pluck('transaction_status.name', 'transaction_status_id');
                    $transactionSyncStatus = $transactionContinueRuleAccordance->pluck('transaction_sync_status.name', 'transaction_sync_status_id');
                    $message = $transactionContinueRuleAccordance->pluck('message', 'message')->first();
                    $transactionStatusMessages = $transactionContinueRuleAccordance->pluck( 'message','transaction_status.id');
                } else {
                    session()->flash('flash_message_error', 'Упс! Нельзя редактировать транзакцию со статусом "' . $transaction->transaction_status->name . '"' ?? "");

                    return redirect()->back();
                }
            } else {
                session()->flash('flash_message_error', 'Упс! Нельзя редактировать транзакцию со статусом "' . $transaction->transaction_status->name . '"' ?? "");

                return redirect()->back();
            }
        }
        Breadcrumbs::setCurrentRoute('admin.transactions.edit', $transaction);

        return view('backend.transaction.transaction.edit', compact('transaction', 'transactionStatuses', 'message', 'transactionSyncStatus', 'transactionStatusMessages'));
    }

    public function resend($id)
    {
        $transaction = $this->transactionRepository->resend($id);
        event(new UserModifiedEvent($transaction, Events::UPDATED));
        return redirect()->route('admin.transactions.index');
    }

    public function continue_process($id)
    {
        $transaction = $this->transactionRepository->continue_process($id);
        event(new UserModifiedEvent($transaction, Events::UPDATED));
        return redirect()->route('admin.transactions.index');
    }

    public function return($id)
    {
        $data['transaction_id'] = $id;
        $data['status_id'] = TransactionStatus::RETURNED;
        $data['status_detail_id'] = TransactionStatusDetail::OK;
        $data['comment'] = trans('transaction.backend.comment_return', ['attribute' => Auth::user()->username]);
        $transaction = $this->transactionService->changeStatusAndCalculateBalance($data);
        event(new UserModifiedEvent($transaction, Events::UPDATED));
        return redirect()->route('admin.transactions.index');
    }

    public function showChild($parent_id, $id)
    {
        return $this->show($id);
    }

    public function show($id)
    {
        $transaction = $this->transactionRepository->findById($id);
        $transactionHistories = $transaction->transaction_histories()->with('TransactionType','service','TransactionType','TransactionStatus','TransactionStatusDetail','Users','from_account','to_account')->orderBy('updated_at', 'desc')->get();
        $transactionStatuses = $this->transactionStatuses->all()->pluck('name', 'id')->toArray();

        $selectedTransactionStatus = $transaction->transaction_status_id;

        Breadcrumbs::setCurrentRoute('admin.transactions.show', $transaction);
        return view('backend.transaction.transaction.show', compact('transaction', 'transactionHistories','transactionStatuses','selectedTransactionStatus'));
    }

    public function destroy($id)
    {
        try {
            $transaction = $this->transactionRepository->destroy($id);
            event(new UserModifiedEvent($transaction, Events::DELETED));
            session()->flash('flash_message', trans('alerts.general.success_delete'));
            return redirect()->route('admin.transactions.index');
        } catch (\Exception $e) {
            session()->flash('flash_message_error', trans('errorMessages.errors.try_errors.' . $e->getCode()));
            return redirect()->route('admin.transactions.index');
        }
    }

    /*public function store(StoreTransactionRequest $request)
    {
        $transaction = $this->transactionRepository->create($request->validated());
        $transaction->setChanges($transaction->getAttributes());
        event(new UserModifiedEvent($transaction, Events::CREATED));
        session()->flash('flash_message', trans('alerts.general.success_add'));
        return redirect()->route('admin.transactions.index');
    }*/

    public function update(UpdateTransactionRequest $request, $id)
    {
        $data = $request->validated();

        //dd($data);
        if($data['send_to_processing']=='on')
            $data['is_queued'] = '-1';

        $transaction = $this->transactionRepository->findById($id);

        if ($transaction->transaction_status_id == TransactionStatus::COMPLETED && $request['transaction_status_id']!=TransactionStatus::COMPLETED)
        {
            session()->flash('flash_message_error', 'Упс! Нельзя редактировать транзакцию со статусом "'.$transaction->transaction_status->name.'"'??"");
            return redirect()->route('admin.transactions.index');
        }

        $transaction = $this->transactionRepository->update($data, $id);
        $transactionHistories = $this->transactionHistoryRepository->findByTransactionId($transaction->id);
        if (count($transactionHistories) > 0 && isset($transactionHistories[0])){
            $dataTransactionHistory = $transactionHistories[0]->toArray();
            $keyUnsetTransactionHistory = [
                'created_at',
                'updated_at',
                'id',
            ];
            foreach ($keyUnsetTransactionHistory as $item) {
                if (isset($dataTransactionHistory[$item])){
                    unset($dataTransactionHistory[$item]);
                }
            }
            $dataTransactionHistory['transaction_status_id'] = $data['transaction_status_id'];
            $dataTransactionHistory['comment'] = ($data['comment'] ?? ''). ' Пользователь ФИО - '. Auth::user()->fullNameExtendedFormat;
            $this->transactionHistoryRepository->create($dataTransactionHistory);
        }
        if($transaction->transaction_status_id == TransactionStatus::COMPLETED && $transaction->service_id==Service::MERCHANT){  // Продолжения процесса для транзакции Оплата по Qr
            if($data['send_to_processing']=='on') {
                \Artisan::call('transaction_merchant:continue-process',['transaction_id' => $transaction->id]);
            }
        }else{   ///Продолжения процесса для обычных транзакции
            if($data['send_to_processing']=='on') {
                \Artisan::call('transaction:continue-process');
            }
        }


        event(new UserModifiedEvent($transaction, Events::UPDATED));
        session()->flash('flash_message', trans('alerts.general.success_edit'));
        return redirect()->route('admin.transactions.index');
    }

    public function changeTransactionSyncStatus(ChangeSyncStatusTransactionRequest $request, $id)
    {
        try {
            $data = $request->validated();
            $transaction = $this->transactionRepository->changeTransactionSyncStatus($data['transaction_sync_status_id'], $id);

            event(new UserModifiedEvent($transaction, Events::UPDATED));
            session()->flash('flash_message', trans('alerts.general.success_edit'));

            return redirect()->route('admin.transactions.index', $id);
        } catch (\Exception $e) {
            session()->flash('flash_message_error', trans('errorMessages.errors.try_errors.' . $e->getCode()));
            return redirect()->route('admin.transactions.index', $id);
        }
    }
}