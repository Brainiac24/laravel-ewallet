<?php
namespace App\Reports\ReportType;

use App\Reports\BaseReporter;
use Illuminate\Contracts\View\View;
use App\Repositories\Backend\Transaction\TransactionRepositoryContract;
use App\Http\Requests\Backend\Web\Report\IndexBeetweenEwalletEskhataTransactionsRequest;
use App\Repositories\Backend\Transaction\TransactionStatus\TransactionStatusRepositoryContract;
use App\Services\Backend\Web\ExportJob\BeetweenEwalletEskhataTransactionsExportJob\BeetweenEwalletEskhataTransactionsExportJobServiceContract;
use Illuminate\Foundation\Http\FormRequest;

class BeetweenEwalletEskhataTransactions extends BaseReporter
{
    protected $transactionRepository;
    protected $transactionStatuses;
    protected $beetweenEwalletEskhataTransactionsExportJobService;

    public function __construct(TransactionRepositoryContract $transactionRepositoryContract,
                                TransactionStatusRepositoryContract $transactionStatusRepositoryContract,
                                BeetweenEwalletEskhataTransactionsExportJobServiceContract $beetweenEwalletEskhataTransactionsExportJobServiceContract)
    {
        $this->transactionRepository = $transactionRepositoryContract;
        $this->transactionStatuses = $transactionStatusRepositoryContract;
        $this->beetweenEwalletEskhataTransactionsExportJobService = $beetweenEwalletEskhataTransactionsExportJobServiceContract;
    }

    public function indexView(array $data) : View
    {
        $type_code = "beetweenEwalletEskhataTransactions";
        $beetweenEwalletEskhataTransactions = $this->transactionRepository->paginateForBeetweenEwalletEskhataTransaction($data);
        $transactionStatuses = $this->transactionStatuses->all()->pluck('name', 'id')->prepend("", "")->toArray();
        $beetweenEwalletEskhataTransactions->appends($data);
        return view('backend.reports.index', compact('beetweenEwalletEskhataTransactions', 'transactionStatuses', 'data', 'type_code'));

    }

    public function exportToCsv(array $data) : void
    {
        //Костыль надо думать как можно организовать через FormRequest
        if(empty($data["from_date"]) && empty($data["from_date_finish"])) {
            throw new \Exception('Поле from date или from date finish обязательно для заполнения, когда export указано.');
        }
        $this->beetweenEwalletEskhataTransactionsExportJobService->create($data);
    }

    public function searchFiledsView() : View
    {
        $data = [];
        $transactionStatuses = $this->transactionStatuses->all()->pluck('name', 'id')->prepend("","")->toArray();
        return view('backend.reports.partials.fields_search_boxes.beetweenEwalletEskhataTransactions', compact( 'data', 'transactionStatuses'));
    }

    public function getRequest() : FormRequest
    {
        return \App::make(IndexBeetweenEwalletEskhataTransactionsRequest::class);
    }
}