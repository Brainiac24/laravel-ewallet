<?php


namespace App\Repositories\Backend\CoordinatePoint\CoordinatePointTypeService;


use App\Models\CoordinatePoint\CoordinatePointTypeService\CoordinatePointTypeService;

class CoordinatePointTypeServiceEloquentContract implements CoordinatePointTypeServiceRepositoryContract
{

    protected $coordinatePointTypeService;

    public function __construct(CoordinatePointTypeService $coordinatePointTypeService)
    {
        $this->coordinatePointTypeService=$coordinatePointTypeService;
    }

    public function all($search)
    {
        return $this->coordinatePointTypeService->where('id', 'like', '%' . $search . '%')->orderBy('id')->get();
    }

    public function findById($id)
    {
        return $this->coordinatePointTypeService->findOrFail($id);
    }

    public function create(array $data)
    {
        return $this->coordinatePointTypeService->create($data);
    }

    public function update(array $data, $id)
    {
        $coordinatePointTypeService = $this->coordinatePointTypeService->findOrFail($id);
        $coordinatePointTypeService->setOldAttributes($coordinatePointTypeService->getAttributes());
        $coordinatePointTypeService->update($data);
        return $coordinatePointTypeService;
    }

    public function destroy($id)
    {
        $coordinatePointTypeService = $this->coordinatePointTypeService->findOrFail($id);
        $coordinatePointTypeService->is_active = 0;
        $coordinatePointTypeService->save();
        return $coordinatePointTypeService;
    }

    public function paginate($perPage = 30)
    {
        return $this->coordinatePointTypeService->orderBy('name')->paginate($perPage);
    }

    public function GetAllByTypeId($coordinate_point_type_id)
    {
        return $this->coordinatePointTypeService
            ->where('coordinate_point_type_id',$coordinate_point_type_id)
            ->with('coordinate_point_type','coordinate_point_service')
            ->get();

    }
}