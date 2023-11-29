<?php
namespace App\Reports\ReportType;

use App\Http\Requests\Backend\Web\Account\AccountHistory\IndexAccountHistoryRequest;
use App\Reports\BaseReporter;
use App\Repositories\Backend\Account\AccountHistory\AccountHistoryRepositoryContract;
use App\Repositories\Backend\Transaction\TransactionStatus\TransactionStatusRepositoryContract;
use App\Repositories\Backend\Transaction\TransactionType\TransactionTypeRepositoryContract;
use App\Services\Backend\Web\ExportJob\ReplenishmentEwalletEskhataTransactionsExportJob\ReplenishmentEwalletEskhataTransactionsExportJobServiceContract;
use App\Services\Common\Helpers\AccountTypes;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Http\FormRequest;

class ReplenishmentEwalletEskhataTransactions extends BaseReporter
{
    protected $accountHistoryRepository;
    protected $replenishmentEwalletEskhataTransactionsExportJobService;
    protected $transactionTypeRepository;
    protected $transactionStatusRepository;

    public function __construct(
        AccountHistoryRepositoryContract $accountHistoryRepository,
        ReplenishmentEwalletEskhataTransactionsExportJobServiceContract $replenishmentEwalletEskhataTransactionsExportJobService,
        TransactionTypeRepositoryContract $transactionTypeRepository,
        TransactionStatusRepositoryContract $transactionStatusRepository
    )
    {
        $this->accountHistoryRepository = $accountHistoryRepository;
        $this->replenishmentEwalletEskhataTransactionsExportJobService = $replenishmentEwalletEskhataTransactionsExportJobService;
        $this->transactionStatusRepository = $transactionStatusRepository;
        $this->transactionTypeRepository = $transactionTypeRepository;
    }

    public function indexView(array $data) : View
    {
        $type_code = "replenishmentEwalletEskhataTransactions";
        $replenishmentEwalletEskhataTransactions = $this->accountHistoryRepository->paginate($data+['account_type_id'=>AccountTypes::EWALLET_ESKHATA]);
        $transactionStatuses = $this->transactionStatusRepository->listsAll()->prepend('', '');
        $transactionTypes = $this->transactionTypeRepository->listsAll()->prepend('', '');
        $replenishmentEwalletEskhataTransactions->appends($data);
        return view('backend.reports.index', compact('replenishmentEwalletEskhataTransactions', 'data', 'transactionStatuses', 'transactionTypes', 'type_code'));
    }

    public function exportToCsv(array $data) : void
    {
        if(empty($data["from_date"])) {
            throw new \Exception('Поле from date обязательно для заполнения, когда export указано.');
        }
        $this->replenishmentEwalletEskhataTransactionsExportJobService->create($data);
    }

    public function searchFiledsView() : View
    {
        $data = [];
        $transactionStatuses = $this->transactionStatusRepository->listsAll()->prepend('', '');
        $transactionTypes = $this->transactionTypeRepository->listsAll()->prepend('', '');
        return view('backend.reports.partials.fields_search_boxes.replenishmentEwalletEskhataTransactions', compact( 'data', 'transactionStatuses', 'transactionTypes'));
    }

    public function getRequest() : FormRequest
    {
        return \App::make(IndexAccountHistoryRequest::class);
    }
}