<?php


namespace App\Services\Backend\Web\ExportJob\OrderExportJob;


use App\Exports\Order\OrderExportCsv;
use App\Jobs\ExportToCsvJob;
use App\Repositories\Backend\Job\JobHistory\JobHistoryRepositoryContract;
use DB;
use Illuminate\Support\Carbon;

class OrderExportJobService implements OrderExportJobServiceContract
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
            $jobHistoryData["name"] = "OrderExport";
            $jobHistoryData["created_by_user_id"] = \Auth::user()->id;
            $jobHistoryData["filename"] = "Orders_filtered_".Carbon::now()->format("Y_m_d_h_i_s").".csv";
            $jobHistory = $this->jobHistoryRepository->create($jobHistoryData);
            ExportToCsvJob::dispatch(new OrderExportCsv($data), $jobHistoryData["filename"], $jobHistory->id);
            \DB::commit();
        }catch (\Exception $e){
            DB::rollBack();
            throw $e;
        }
    }
}