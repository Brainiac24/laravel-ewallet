<?php


namespace App\Services\Backend\Web\ExportJob\TransactionAnalysisEwalletEskhataExportJob;


use App\Exports\Client\ClientExportCsv;
use App\Exports\TransactionAnalysisEwalletEskhata\TransactionAnalysisEwalletEskhataExportCsv;
use App\Jobs\ExportToCsvJob;
use App\Repositories\Backend\Job\JobHistory\JobHistoryRepositoryContract;
use Carbon\Carbon;
use DB;

class TransactionAnalysisEwalletEskhataExportJobService implements TransactionAnalysisEwalletEskhataExportJobServiceContract
{
    private $jobHistoryRepository;

    public function __construct(JobHistoryRepositoryContract $jobHistoryRepository)
    {
        $this->jobHistoryRepository = $jobHistoryRepository;
    }

    public function create($data)
    {
        DB::beginTransaction();
        try {
            $jobHistoryData["name"] = "TransactionAnalysisEwalletEskhataExport";
            $jobHistoryData["created_by_user_id"] = \Auth::user()->id;
            $jobHistoryData["filename"] = "Transaction_analysis_ewallet_eskhata_filtered_".Carbon::now()->format("Y_m_d_h_i_s").".csv";
            $jobHistory = $this->jobHistoryRepository->create($jobHistoryData);
            ExportToCsvJob::dispatch(new TransactionAnalysisEwalletEskhataExportCsv($data), $jobHistoryData["filename"], $jobHistory->id);
            \DB::commit();
        }catch (\Exception $e){
            DB::rollBack();
            throw $e;
        }
    }
}