<?php
/**
 * Created by PhpStorm.
 * User: Nabijon
 * Date: 23.07.2021
 * Time: 11:36
 */

namespace App\Services\Backend\Web\ExportJob\BankExportJob;

use App\Exports\Bank\BankExportCsv;
use App\Jobs\ExportToCsvJob;
use App\Repositories\Backend\Job\JobHistory\JobHistoryRepositoryContract;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class BankExportJobService implements BankExportJobServiceContract
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
            $jobHistoryData["name"] = "BankExport";
            $jobHistoryData["created_by_user_id"] = \Auth::user()->id;
            $jobHistoryData["filename"] = "Banks_filtered_".Carbon::now()->format("Y_m_d_h_i_s").".csv";
            $jobHistory = $this->jobHistoryRepository->create($jobHistoryData);
            ExportToCsvJob::dispatch(new BankExportCsv($data), $jobHistoryData["filename"], $jobHistory->id);
            \DB::commit();
        }catch (\Exception $e){
            DB::rollBack();
            throw $e;
        }
    }
}