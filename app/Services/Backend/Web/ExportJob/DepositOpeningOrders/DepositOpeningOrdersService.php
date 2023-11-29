<?php
/**
 * Created by PhpStorm.
 * User: Nabijon
 * Date: 18.08.2021
 * Time: 19:09
 */

namespace App\Services\Backend\Web\ExportJob\DepositOpeningOrders;


use App\Exports\DepositOpeningOrders\DepositOpeningOrdersExportCsv;
use App\Jobs\ExportToCsvJob;
use App\Repositories\Backend\Job\JobHistory\JobHistoryRepositoryContract;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DepositOpeningOrdersService implements DepositOpeningOrdersServiceContract
{
    private $jobHistoryRepository;

    public function __construct(JobHistoryRepositoryContract $jobHistoryRepository)
    {
        $this->jobHistoryRepository = $jobHistoryRepository;
    }

    public function create($data)
    {

        try {
            DB::beginTransaction();
            $jobHistoryData["name"] = "DepositOpeningOrders";
            $jobHistoryData["created_by_user_id"] = \Auth::user()->id;
            $jobHistoryData["filename"] = "DepositOpeningOrders_filtered_".Carbon::now()->format("Y_m_d_h_i_s").".csv";
            $jobHistory = $this->jobHistoryRepository->create($jobHistoryData);

            ExportToCsvJob::dispatch(new DepositOpeningOrdersExportCsv($data), $jobHistoryData["filename"], $jobHistory->id);
            \DB::commit();
        }catch (\Exception $e){
            DB::rollBack();
            throw $e;
        }
    }
}