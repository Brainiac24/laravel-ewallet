<?php
/**
 * Created by PhpStorm.
 * User: Nabijon
 * Date: 11.11.2021
 * Time: 11:23
 */

namespace App\Services\Backend\Web\ExportJob\KortiMilliTransactionExportJob;


use App\Exports\KortiMilliTransactions\KortiMilliTransactionExportCsv;
use App\Jobs\ExportToCsvJob;
use App\Repositories\Backend\Job\JobHistory\JobHistoryRepositoryContract;
use App\Services\Common\Helpers\JobHistoryType;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class KortiMilliTransactionExportJobService implements KortiMilliTransactionExportJobServiceContract
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
            $jobHistoryData["name"] = "KortiMilliTransactionExport";
            $jobHistoryData["created_by_user_id"] = \Auth::user()->id;
            $jobHistoryData["filename"] = "KortiMilliTransactions_filtered_".Carbon::now()->format("Y_m_d_h_i_s").".csv";
            $jobHistoryData["type"] = JobHistoryType::EXPORT;
            $jobHistory = $this->jobHistoryRepository->create($jobHistoryData);
            ExportToCsvJob::dispatch(new KortiMilliTransactionExportCsv($data), $jobHistoryData["filename"], $jobHistory->id);
            \DB::commit();
        }catch (\Exception $e){
            DB::rollBack();
            throw $e;
        }
    }
}