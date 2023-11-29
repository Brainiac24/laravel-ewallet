<?php


namespace App\Repositories\Backend\Schedule\ScheduleType;


use App\Models\Schedule\ScheduleType\ScheduleType;
use App\Services\Common\Helpers\ScheduleType as ScheduleTypeHelper;

class ScheduleTypeEloquentRepository implements ScheduleTypeRepositoryContract
{
    protected $scheduleType;

    public function __construct(ScheduleType $scheduleType)
    {
        $this->scheduleType = $scheduleType;
    }

    public function all($search = '')
    {
        return $this->scheduleType->where('name', 'LIKE', '%'.$search.'%')->get();
    }

    public function paginate($perPage = 30, $columns = ['*'])
    {
        return $this->scheduleType->select($columns)->paginate(30);
    }

    public function findById($id)
    {
        return $this->scheduleType->findOrFail($id);
    }

    public function update(array $data, $id)
    {
        $scheduleType = $this->findById($id);
        $scheduleType->update($data);
        return $scheduleType;
    }

    public function destroy($id)
    {
        $schedulType = $this->findById($id);
        $schedulType->is_active = 0;
        $schedulType->save();
        return $schedulType;
    }

    public function create(array $data)
    {
        return $this->scheduleType->create($data);
    }

    public function getAllTypeCommand()
    {
        return $this->scheduleType->where('type', ScheduleTypeHelper::COMMAND)->get();
    }

    public function getAllTypeJob()
    {
        return $this->scheduleType->where('type', ScheduleTypeHelper::JOB)->get();
    }
}