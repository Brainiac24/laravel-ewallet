<?php

namespace App\Services\Backend\Web\ExportJob\BeetweenEwalletEskhataTransactionsExportJob;


use App\Services\Common\Helpers\JobHistoryType;
use DB;
use Carbon\Carbon;
use App\Jobs\ExportToCsvJob;
use App\Repositories\Backend\Job\JobHistory\JobHistoryRepositoryContract;
use App\Exports\BeetweenEwalletEskhataTransactions\BeetweenEwalletEskhataTransactionsExportCsv;

class BeetweenEwalletEskhataTransactionsExportJobService implements BeetweenEwalletEskhataTransactionsExportJobServiceContract
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
            $jobHistoryData["name"] = "BeetweenEwalletEskhataTransactionsExport";
            $jobHistoryData["created_by_user_id"] = \Auth::user()->id;
            $jobHistoryData["filename"] = "BeetweenEwalletEskhataTransactionsExport_filtered_".Carbon::now()->format("Y_m_d_h_i_s").".csv";
            $jobHistoryData["type"] = JobHistoryType::EXPORT;
            $jobHistory = $this->jobHistoryRepository->create($jobHistoryData);
            ExportToCsvJob::dispatch(new BeetweenEwalletEskhataTransactionsExportCsv($data), $jobHistoryData["filename"], $jobHistory->id);
            \DB::commit();
        }catch (\Exception $e){
            DB::rollBack();
            throw $e;
        }
    }
}