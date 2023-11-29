<?php


namespace App\Repositories\Backend\CoordinatePoint\CoordinatePointType;


use App\Events\Backend\CoordinatePoint\CoordinatePointType\CoordinatePointTypeModifiedEvent;
use App\Models\CoordinatePoint\CoordiantePointType\CoordinatePointType;

class CoordinatePointTypeEloquentRepository implements CoordinatePointTypeRepositoryContract
{
    protected $coordiantePointType;

    public function __construct(CoordinatePointType $coordiantePointType)
    {
        $this->coordiantePointType=$coordiantePointType;
    }

    public function all($search)
    {
        return $this->coordiantePointType->where('name', 'like', '%' . $search . '%')->orderBy('name')->get();
    }

    public function findById($id)
    {
        return $this->coordiantePointType->findOrFail($id);
    }

    public function create(array $data)
    {
        return $this->coordiantePointType->create($data);
    }

    public function update(array $data, $id)
    {
        $coordiantePointType = $this->coordiantePointType->findOrFail($id);
        $coordiantePointType->setOldAttributes($coordiantePointType->getAttributes());
        $coordiantePointType->update($data);
        foreach ($coordiantePointType->getOldAttributes() as $key => $oldAttribute) {
            if (isset($data[$key]) && $data[$key] != $oldAttribute && $key != 'updated_at'){
                event(new CoordinatePointTypeModifiedEvent($coordiantePointType));
                return $coordiantePointType;
            }
        }
        return $coordiantePointType;
    }

    public function destroy($id)
    {
        $coordiantePointType = $this->coordiantePointType->findOrFail($id);
        $coordiantePointType->is_active = 0;
        $coordiantePointType->save();
        return $coordiantePointType;
    }

    public function paginate($perPage = 30)
    {
        return $this->coordiantePointType
            ->with(['coordinate_point_workday'])
            ->orderBy('name')
            ->paginate($perPage);
    }
}