<?php


namespace App\Repositories\Backend\Schedule;


use App\Models\Schedule\Schedule;
use App\Models\Schedule\ScheduleType\ScheduleType;

class ScheduleEloquentRepository implements ScheduleRepositoryContract
{
    protected $schedule;

    public function __construct(Schedule $schedule)
    {
        $this->schedule = $schedule;
    }

    public function all($search = '')
    {
        return $this->schedule->where('name', 'LIKE', '%'.$search.'%')->get();
    }

    public function paginate($perPage = 30, $columns = ['*'])
    {
        return $this->schedule->with(['scheduleType', 'createByUser'])->select($columns)->paginate(30);
    }

    public function findById($id)
    {
        return $this->schedule->findOrFail($id);
    }

    public function update(array $data, $id)
    {
        $schedule = $this->findById($id);
        $schedule->update($data);
        return $schedule;
    }

    public function destroy($id)
    {
        $schedule = $this->findById($id);
        $schedule->is_active = 0;
        $schedule->save();
        return $schedule;
    }

    public function create(array $data)
    {
        $data['create_by_user_id'] = \Auth::id();
        return $this->schedule->create($data);
    }
}