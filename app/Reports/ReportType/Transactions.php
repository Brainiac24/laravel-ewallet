<?php
namespace App\Reports\ReportType;

use App\Http\Requests\Backend\Web\Report\IndexTransactionRequest;
use App\Http\Resources\Backend\Web\Transaction\TransactionListResource;
use App\Reports\BaseReporter;
use App\Repositories\Backend\Gateway\GatewayRepositoryContract;
use App\Repositories\Backend\Merchant\MerchantRepositoryContract;
use App\Repositories\Backend\Service\ServiceRepositoryContract;
use App\Repositories\Backend\Transaction\TransactionRepositoryContract;
use App\Repositories\Backend\Transaction\TransactionStatus\TransactionStatusRepositoryContract;
use App\Repositories\Backend\Transaction\TransactionStatusGroup\TransactionStatusGroupRepositoryContract;
use App\Repositories\Backend\Transaction\TransactionSyncStatus\TransactionSyncStatusRepositoryContract;
use App\Services\Backend\Web\ExportJob\TransactionExportJob\TransactionExportJobService;
use App\Services\Backend\Web\ExportJob\TransactionExportJob\TransactionExportJobServiceContract;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Http\FormRequest;

class Transactions extends BaseReporter
{
    protected $transactionRepository;
    protected $serviceRepository;
    protected $transactionStatuses;
    protected $transactionStatusGroupRepository;
    protected $transactionSyncStatusRepository;
    protected $transactionExportJobServiceContract;
    protected $indexRequest;
    protected $merchantRepository;
    protected $gatewaysRepository;

    public function __construct(TransactionRepositoryContract $transactionRepositoryContract,
                                ServiceRepositoryContract $serviceRepositoryContract,
                                TransactionStatusRepositoryContract $transactionStatusRepositoryContract,
                                TransactionStatusGroupRepositoryContract $transactionStatusGroupRepositoryContract,
                                TransactionSyncStatusRepositoryContract $transactionSyncStatusRepositoryContract,
                                TransactionExportJobServiceContract $transactionExportJobServiceContract,
                                MerchantRepositoryContract $merchantRepository,
                                GatewayRepositoryContract $gatewayRepositoryContract
)
    {
        $this->transactionRepository = $transactionRepositoryContract;
        $this->serviceRepository = $serviceRepositoryContract;
        $this->transactionStatuses = $transactionStatusRepositoryContract;
        $this->transactionStatusGroupRepository = $transactionStatusGroupRepositoryContract;
        $this->transactionSyncStatusRepository = $transactionSyncStatusRepositoryContract;
        $this->transactionExportJobServiceContract = $transactionExportJobServiceContract;
        $this->merchantRepository=$merchantRepository;
        $this->gatewaysRepository = $gatewayRepositoryContract;
    }
    public function indexView(array $data) : View
    {
        $type_code = "transactions";

        $transactions = $this->transactionRepository->paginate($data);
        $services = $this->serviceRepository->allPluck();
        $transactionStatuses = $this->transactionStatuses->all()->pluck('name', 'id')->toArray();
        $transactionStatusGroups = $this->transactionStatusGroupRepository->all()->pluck('name', 'id')->toArray();
        $transactionSyncStatus = $this->transactionSyncStatusRepository->all()->pluck('name', 'id')->toArray();
        $merchants=$this->merchantRepository->all('')->pluck('name', 'id')->toArray();
        $gateways = $this->gatewaysRepository->all()->pluck('name', 'id')->prepend('', '');
        $transactions_to_array = TransactionListResource::collection($transactions);

        $transactions->appends($data);
        return view('backend.reports.index', compact('transactions', 'transactions_to_array',
            'data', 'services', 'transactionStatuses', 'transactionStatusGroups', 'transactionSyncStatus','type_code', 'merchants', 'gateways'));

    }

    public function exportToCsv(array $data) : void
    {
        //Костыль надо думать как можно организовать через FormRequest
        if(empty($data["from_date"]) && empty($data["from_date_finish"])) {
           throw new \Exception('Поле from date или from date finish обязательно для заполнения, когда export указано.');
        }

        $this->transactionExportJobServiceContract->create($data);
    }

    public function searchFiledsView() : View
    {
        $data = [];
        $services = $this->serviceRepository->allPluck();
        $transactionStatuses = $this->transactionStatuses->all()->pluck('name', 'id')->toArray();
        $transactionStatusGroups = $this->transactionStatusGroupRepository->all()->pluck('name', 'id')->toArray();
        $transactionSyncStatus = $this->transactionSyncStatusRepository->all()->pluck('name', 'id')->toArray();

        return view('backend.reports.partials.fields_search_boxes.transactions', compact( 'data', 'services', 'transactionStatuses', 'transactionStatusGroups', 'transactionSyncStatus'));
    }

    public function getRequest() : FormRequest
    {
        return \App::make(IndexTransactionRequest::class);
    }
}