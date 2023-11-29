<?php


namespace App\Repositories\Backend\Schedule\ScheduleJob;


use App\Models\Schedule\ScheduleJob\ScheduleJob;

class ScheduleJobEloquentRepository implements ScheduleJobRepositoryContract
{
    protected $scheduleJob;

    public function __construct(ScheduleJob $scheduleJob)
    {
        $this->scheduleJob = $scheduleJob;
    }

    public function paginate($perPage = 30, $columns = ['*'])
    {
        return $this->scheduleJob->select($columns)->paginate(30);
    }

    public function findById($id)
    {
        return $this->scheduleJob->findOrFail($id);
    }
}