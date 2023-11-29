<?php

namespace App\Repositories\Backend\Job\JobHistory;

use App\Models\Job\JobHistory\Filters\JobHistoryFilter;
use App\Models\Job\JobHistory\JobHistory;

class JobHistoryEloquentRepository implements JobHistoryRepositoryContract
{
    /**
     * @var JobHistory
     */
    private $jobHistory;

    /**
     * JobHistoryEloquentRepository constructor.
     * @param JobHistory $jobHistory
     */
    public function __construct(JobHistory $jobHistory)
    {
        $this->jobHistory = $jobHistory;
    }


    public function all($data = [], $columns = ['*'])
    {
       return $this->jobHistory->orderBy('created_at', 'desc')->filterBy(new JobHistoryFilter($data))->get($columns);
    }

    public function paginate($data = [], $perPage = 30, $columns = ['*'])
    {
        return $this->jobHistory->select($columns)
            ->with('createdBy')
            ->filterBy(new JobHistoryFilter($data))
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);
    }

    public function create(array $data)
    {
        $jobHistory = new JobHistory($data);
        $jobHistory->save();
        return $jobHistory;
    }

    public function update(array $data, $id)
    {
        $jobHistory = $this->jobHistory->findOrFail($id);
        $jobHistory->setOldAttributes($jobHistory->getAttributes());
        $jobHistory->update($data);
        return $jobHistory;
    }

    public function findById($id)
    {
        return $this->jobHistory->
        with('createdBy')->
        where('id', $id)->firstOrFail();
    }

}