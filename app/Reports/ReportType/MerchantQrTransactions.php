<?php
namespace App\Reports\ReportType;

use App\Reports\BaseReporter;
use App\Repositories\Backend\Merchant\MerchantRepositoryContract;
use App\Repositories\Backend\Transaction\TransactionRepositoryContract;
use App\Http\Requests\Backend\Web\Report\IndexMerchantQrTransactionsRequest;
use App\Repositories\Backend\Transaction\TransactionStatus\TransactionStatusRepositoryContract;
use App\Services\Backend\Web\ExportJob\MerchantQrTransactionsExportJob\MerchantQrTransactionsExportJobServiceContract;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Http\FormRequest;

class MerchantQrTransactions extends BaseReporter
{
    protected $transactionRepository;
    protected $merchantRepository;
    protected $transactionStatuses;
    protected $merchantQrTransactionsExportJobService;

    public function __construct(
                                TransactionRepositoryContract $transactionRepositoryContract,
                                TransactionStatusRepositoryContract $transactionStatusRepositoryContract,
                                MerchantQrTransactionsExportJobServiceContract $merchantQrTransactionsExportJobServiceContract,
                                MerchantRepositoryContract $merchantRepositoryContract
    )
    {
        $this->transactionRepository = $transactionRepositoryContract;
        $this->transactionStatuses = $transactionStatusRepositoryContract;
        $this->merchantQrTransactionsExportJobService = $merchantQrTransactionsExportJobServiceContract;
        $this->merchantRepository = $merchantRepositoryContract;
    }

    public function indexView(array $data) : View
    {
        $type_code = "merchantQrTransactions";

        $merchantQrTransactions = $this->transactionRepository->paginateForMerchantQrTransaction($data);
        $merchants = $this->merchantRepository->listByUserBranch();
        $transactionStatuses = $this->transactionStatuses->all()->pluck('name', 'id')->prepend("","")->toArray();
        $merchantQrTransactions->appends($data);

        return view('backend.reports.index', compact('merchantQrTransactions', 'transactionStatuses', 'merchants', 'data', 'type_code'));
    }

    public function exportToCsv(array $data) : void
    {
        if(empty($data["from_date"]) && empty($data["from_date_finish"])) {
            throw new \Exception('Поле from date или from date finish обязательно для заполнения, когда export указано.');
        }
        $this->merchantQrTransactionsExportJobService->create($data);
    }

    public function searchFiledsView() : View
    {
        $data = [];
        $merchants = $this->merchantRepository->listByUserBranch();
        $transactionStatuses = $this->transactionStatuses->all()->pluck('name', 'id')->prepend("","")->toArray();
        return view('backend.reports.partials.fields_search_boxes.merchantQrTransactions', compact( 'data', 'transactionStatuses', 'merchants'));
    }

    public function getRequest() : FormRequest
    {
        return \App::make(IndexMerchantQrTransactionsRequest::class);
    }
}