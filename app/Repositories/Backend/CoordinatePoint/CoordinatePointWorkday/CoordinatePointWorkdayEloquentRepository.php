<?php


namespace App\Repositories\Backend\CoordinatePoint\CoordinatePointWorkday;


use App\Events\Backend\CoordinatePoint\CoordinatePointWorkday\CoordinatePointWorkdayModifiedEvent;
use App\Models\CoordinatePoint\CoordinatePointWorkday\CoordinatePointWorkday;

class CoordinatePointWorkdayEloquentRepository implements CoordinatePointWorkdayRepositoryContract
{

    protected $coordinatePointWorkday;

    public function __construct(CoordinatePointWorkday $coordinatePointWorkday)
    {
        $this->coordinatePointWorkday=$coordinatePointWorkday;
    }

    public function all($search='')
    {
        return $this->coordinatePointWorkday->where('name', 'like', '%' . $search . '%')->orderBy('name')->get();
    }

    public function findById($id)
    {
        return $this->coordinatePointWorkday->findOrFail($id);
    }

    public function create(array $data)
    {
        return $this->coordinatePointWorkday->create($data);
    }

    public function update(array $data, $id)
    {
        $coordinatePointWorkday = $this->coordinatePointWorkday->findOrFail($id);
        $coordinatePointWorkday->setOldAttributes($coordinatePointWorkday->getAttributes());
        $coordinatePointWorkday->update($data);
        foreach ($coordinatePointWorkday->getOldAttributes() as $key => $oldAttribute) {
            if (isset($data[$key]) && $data[$key] != $oldAttribute && $key != 'updated_at'){
                event(new CoordinatePointWorkdayModifiedEvent($coordinatePointWorkday));
                return $coordinatePointWorkday;
            }
        }
        return $coordinatePointWorkday;
    }

    public function destroy($id)
    {
        $coordinatePointWorkday = $this->coordinatePointWorkday->findOrFail($id);
        $coordinatePointWorkday->is_active = 0;
        $coordinatePointWorkday->save();
        return $coordinatePointWorkday;
    }

    public function paginate($perPage = 30)
    {
        return $this->coordinatePointWorkday->orderBy('name')->paginate($perPage);
    }
}