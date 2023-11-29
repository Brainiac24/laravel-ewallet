<?php


namespace App\Reports\ReportType;


use App\Http\Requests\Backend\Web\Report\IndexTransactionAnalysisEwalletEskhataRequest;
use App\Reports\BaseReporter;
use App\Repositories\Backend\ReportAnalysis\ReportAnalysisRepositoryContract;
use App\Services\Backend\Web\ExportJob\TransactionAnalysisEwalletEskhataExportJob\TransactionAnalysisEwalletEskhataExportJobServiceContract;
use App\Services\Common\Helpers\AccountTypes;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Http\FormRequest;

class TransactionAnalysisEwalletEskhata extends BaseReporter
{
    protected $reportAnalysisRepository;
    protected $transactionAnalysisEwalletEskhataExportJobService;

    public function __construct(ReportAnalysisRepositoryContract $reportAnalysisRepository,
                    TransactionAnalysisEwalletEskhataExportJobServiceContract $transactionAnalysisEwalletEskhataExportJobService)
    {
        $this->reportAnalysisRepository = $reportAnalysisRepository;
        $this->transactionAnalysisEwalletEskhataExportJobService = $transactionAnalysisEwalletEskhataExportJobService;
    }

    public function indexView(array $data): View
    {
        $type_code = "transactionAnalysisEwalletEskhata";
        $reportAnalysisFilters = $this->reportAnalysisRepository->listsAll();

        return view('backend.reports.index', compact('data', 'reportAnalysisFilters','type_code'));
    }

    public function searchFiledsView(): View
    {
        $data = [];
        $reportAnalysisFilters = $this->reportAnalysisRepository->listsAll();

        return view('backend.reports.partials.fields_search_boxes.transactionAnalysisEwalletEskhata', compact('data',
             'reportAnalysisFilters'));
    }

    public function exportToCsv(array $data): void
    {
        if(empty($data["from_created_at"])) {
            throw new \Exception('Поле from date обязательно для заполнения, когда export указано.');
        }
        $this->transactionAnalysisEwalletEskhataExportJobService->create($data);
    }

    public function getRequest(): FormRequest
    {
        return \App::make(IndexTransactionAnalysisEwalletEskhataRequest::class);
    }
}