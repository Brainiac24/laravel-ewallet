<?php


namespace App\Repositories\Backend\Schedule\ScheduleJob;


interface ScheduleJobRepositoryContract
{

    public function paginate($perPage = 30, $columns = ['*']);

    public function findById($id);

}