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
use App\Models\JobLog\JobLogDwh;

class JobLogArchiveEloquentRepository implements JobLogArchiveRepositoryContract
{
    /**
     * @var JobLog
     */
    private $jobLog;

    /**
     * JobLogEloquentRepository constructor.
     * @param JobLog $jobLog
     */
    public function __construct(JobLogDwh $jobLog)
    {
        $this->jobLog = $jobLog;
    }

    public function all($data = [], $columns = ['*'])
    {
//        $jobLog = $this->jobLog->orderBy('created_at', 'desc')->scopeFilterBy(new JobLogFilter($data))->get($columns);
        $jobLog = $this->jobLog->orderBy('created_at', 'desc')->filterBy(new JobLogFilter($data))->get($columns);
        return $jobLog;
    }


    public function getAllWithCreatedBy($perPage = 30)
    {
        return $this->jobLog->with('user')->paginate($perPage);
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
        return $this->jobLog->select($columns)
            ->with('createdBy')
            ->filterBy(new JobLogFilter($data))
            ->orderBy('created_at', 'desc')
            ->simplePaginate($perPage);
    }

}