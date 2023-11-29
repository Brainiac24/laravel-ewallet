<?php
/**
 * Created by PhpStorm.
 * User: Nabijon
 * Date: 25.08.2021
 * Time: 21:43
 */

namespace App\Repositories\Backend\JobLog;


use App\Models\JobLog\JobLogDwh;
use App\Services\Common\Helpers\Logger\DwhRulesLogger;
use Illuminate\Support\Facades\Log;

class JobLogDwhEloquentRepository implements JobLogDwhRepositoryContract
{
    public $logger;

    public function __construct()
    {
        $this->logger = new DwhRulesLogger();
    }

    public function create(array $jobLog)
    {
        $jobLogDwh = new JobLogDwh();
        $jobLogDwh->fill($jobLog);
        $jobLogDwh->save();

        return $jobLogDwh;
    }

    public function recordsBeforeDate($date, $groupedJobLogTypes)
    {
        $limit =  config('app_settings.job_log_select_max_rows_for_dwh',null);

        if ($limit){
            return JobLogDwh::where('created_at', '<', $date)->whereIn('type',$groupedJobLogTypes)->limit($limit)->get();
        }
        $this->logger->warning("select limit from job_log table is not set in .env");

        return [];
    }


}