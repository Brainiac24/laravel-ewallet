<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 11.07.2019
 * Time: 10:52
 */

namespace App\Repositories\Backend\JobLog;


use App\Models\JobLog\Filters\JobLogFilter;

use App\Models\JobLog\JobLog;
use App\Services\Common\Helpers\Logger\DwhRulesLogger;

class JobLogEloquentRepository implements JobLogRepositoryContract
{
    /**
     * @var JobLog
     */
    private $jobLog;

    private $logger;

    /**
     * JobLogEloquentRepository constructor.
     * @param JobLog $jobLog
     */
    public function __construct(JobLog $jobLog)
    {
        $this->jobLog = $jobLog;
        $this->logger = new DwhRulesLogger();
    }

    public function all($data = [], $columns = ['*'])
    {
        $jobLogs = $this->jobLog->orderBy('created_at', 'desc')->filterBy(new JobLogFilter($data))->get($columns);

        return $jobLogs;
    }


    public function getAllWithCreatedBy($perPage = 30)
    {
        return $this->jobLog->with('user')->simplePaginate($perPage);
    }

    public function getByIdWithCreatedBy($id)
    {
        return $this->jobLog->with('createdBy')->where('id', $id)->first();
    }

    /**
     * @param array $data
     * @param int $perPage
     * @param array $columns
     * @return mixed
     */
    public function paginate($data = [], $perPage = 30, $columns = ['*'])
    {
        return $this->jobLog::select($columns)
            ->with('createdBy')
            ->filterBy(new JobLogFilter($data))
            ->orderBy('created_at', 'desc')
            ->simplePaginate($perPage);
    }

    public function recordsBeforeDate($date, $groupedJobLogTypes = [])
    {
        $selectLimit =config('app_settings.job_log_select_max_rows_for_dwh', null) ;

        if($selectLimit){
            return $this->jobLog::where('created_at', '<', $date)->whereIn('type', $groupedJobLogTypes)->limit($selectLimit)->get();
        }
        $this->logger->warning("select limit from job_logs table is not set in .env");

        return [];

    }



}