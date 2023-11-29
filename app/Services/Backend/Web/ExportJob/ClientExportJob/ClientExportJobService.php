<?php

namespace App\Services\Backend\Web\ExportJob\ClientExportJob;

use App\Services\Common\Helpers\JobHistoryType;
use DB;
use Carbon\Carbon;
use App\Jobs\ExportToCsvJob;
use App\Exports\Client\ClientExportCsv;
use App\Repositories\Backend\Job\JobHistory\JobHistoryRepositoryContract;

class ClientExportJobService implements ClientExportJobServiceContract
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
            $jobHistoryData["name"] = "ClientExport";
            $jobHistoryData["created_by_user_id"] = \Auth::user()->id;
            $jobHistoryData["filename"] = "Clients_filtered_".Carbon::now()->format("Y_m_d_h_i_s").".csv";
            $jobHistoryData["type"] = JobHistoryType::EXPORT;
            $jobHistory = $this->jobHistoryRepository->create($jobHistoryData);
            ExportToCsvJob::dispatch(new ClientExportCsv($data), $jobHistoryData["filename"], $jobHistory->id);
            \DB::commit();
        }catch (\Exception $e){
            DB::rollBack();
            throw $e;
        }
    }
}