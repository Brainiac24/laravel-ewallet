<?php
/**
 * Created by PhpStorm.
 * User: Nabijon
 * Date: 10.11.2021
 * Time: 13:35
 */

namespace App\Reports\ReportType;


use App\Http\Requests\Backend\Web\Report\IndexKortiMilliTransactionRequest;
use App\Http\Resources\Backend\Web\Transaction\TransactionListResource;
use App\Reports\BaseReporter;
use App\Repositories\Backend\Service\ServiceRepositoryContract;
use App\Repositories\Backend\Transaction\TransactionRepositoryContract;
use App\Repositories\Backend\Transaction\TransactionStatus\TransactionStatusRepositoryContract;
use App\Repositories\Backend\Transaction\TransactionStatusGroup\TransactionStatusGroupRepositoryContract;
use App\Repositories\Backend\Transaction\TransactionSyncStatus\TransactionSyncStatusRepositoryContract;
use App\Services\Backend\Web\ExportJob\KortiMilliTransactionExportJob\KortiMilliTransactionExportJobServiceContract;
use App\Services\Backend\Web\ExportJob\TransactionExportJob\TransactionExportJobServiceContract;
use App\Services\Common\Helpers\Gateway;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Http\FormRequest;

class KortiMilliTransactions extends BaseReporter
{
    protected $transactionRepository;
    protected $serviceRepository;
    protected $transactionStatuses;
    protected $transactionStatusGroupRepository;
    protected $transactionSyncStatusRepository;
    protected $transactionExportJobServiceContract;
    protected $merchantRepository;

    public function __construct(TransactionRepositoryContract $transactionRepositoryContract,
                                ServiceRepositoryContract $serviceRepositoryContract,
                                TransactionStatusRepositoryContract $transactionStatusRepositoryContract,
                                TransactionStatusGroupRepositoryContract $transactionStatusGroupRepositoryContract,
                                TransactionSyncStatusRepositoryContract $transactionSyncStatusRepositoryContract,
                                KortiMilliTransactionExportJobServiceContract $transactionExportJobServiceContract
    )
    {
        $this->transactionRepository = $transactionRepositoryContract;
        $this->serviceRepository = $serviceRepositoryContract;
        $this->transactionStatuses = $transactionStatusRepositoryContract;
        $this->transactionStatusGroupRepository = $transactionStatusGroupRepositoryContract;
        $this->transactionSyncStatusRepository = $transactionSyncStatusRepositoryContract;
        $this->transactionExportJobServiceContract = $transactionExportJobServiceContract;
    }

    public function indexView(array $data) : View
    {
        $type_code = "kortiMilliTransactions";
        $filterData = $data;
        $filterData['from_gateway_or_to_gateway'] = ['from_gateway_id' => Gateway::KORTI_MILLI, 'to_gateway_id'=> Gateway::KORTI_MILLI];
        $transactions = $this->transactionRepository->paginate($filterData);
        $services = $this->serviceRepository->allPluck();
        $transactionStatuses = $this->transactionStatuses->all()->pluck('name', 'id')->toArray();
        $transactionStatusGroups = $this->transactionStatusGroupRepository->all()->pluck('name', 'id')->toArray();
        $transactionSyncStatus = $this->transactionSyncStatusRepository->all()->pluck('name', 'id')->toArray();

        $transactions_to_array = TransactionListResource::collection($transactions);

        $transactions->appends($data);
        return view('backend.reports.index', compact('transactions', 'transactions_to_array', 'data', 'services', 'transactionStatuses', 'transactionStatusGroups', 'transactionSyncStatus','type_code'));

    }

    public function exportToCsv(array $data) : void
    {
        //Костыль надо думать как можно организовать через FormRequest
        if(empty($data["from_date"]) && empty($data["from_date_finish"])) {
            throw new \Exception('Поле from date или from date finish обязательно для заполнения, когда export указано.');
        }
        $data['from_gateway_or_to_gateway'] = ['from_gateway_id' => Gateway::KORTI_MILLI, 'to_gateway_id'=> Gateway::KORTI_MILLI];
        $this->transactionExportJobServiceContract->create($data);
    }

    public function searchFiledsView() : View
    {
        $data = [];
        $services = $this->serviceRepository->allPluck();
        $transactionStatuses = $this->transactionStatuses->all()->pluck('name', 'id')->toArray();
        $transactionStatusGroups = $this->transactionStatusGroupRepository->all()->pluck('name', 'id')->toArray();
        $transactionSyncStatus = $this->transactionSyncStatusRepository->all()->pluck('name', 'id')->toArray();

        return view('backend.reports.partials.fields_search_boxes.kortiMilliTransactions', compact( 'data', 'services', 'transactionStatuses', 'transactionStatusGroups', 'transactionSyncStatus'));
    }

    public function getRequest() : FormRequest
    {
        return \App::make(IndexKortiMilliTransactionRequest::class);
    }

}