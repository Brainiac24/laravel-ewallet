<?php

namespace App\Services\Backend\Web\ExportJob\TransactionExportJob;

use App\Services\Common\Helpers\JobHistoryType;
use DB;
use Carbon\Carbon;
use App\Jobs\ExportToCsvJob;
use App\Exports\Transactions\TransactionExportCsv;
use App\Repositories\Backend\Job\JobHistory\JobHistoryRepositoryContract;

class TransactionExportJobService implements TransactionExportJobServiceContract
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
            $jobHistoryData["name"] = "TransactionExport";
            $jobHistoryData["created_by_user_id"] = \Auth::user()->id;
            $jobHistoryData["filename"] = "Transactions_filtered_".Carbon::now()->format("Y_m_d_h_i_s").".csv";
            $jobHistoryData["type"] = JobHistoryType::EXPORT;
            $jobHistory = $this->jobHistoryRepository->create($jobHistoryData);
            ExportToCsvJob::dispatch(new TransactionExportCsv($data), $jobHistoryData["filename"], $jobHistory->id);
            \DB::commit();
        }catch (\Exception $e){
            DB::rollBack();
            throw $e;
        }
    }
}