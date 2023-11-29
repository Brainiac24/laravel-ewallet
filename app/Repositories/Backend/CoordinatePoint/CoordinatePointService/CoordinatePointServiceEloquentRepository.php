<?php


namespace App\Repositories\Backend\CoordinatePoint\CoordinatePointService;


use App\Models\CoordinatePoint\CoordinatePointService\CoordinatePointService;

class CoordinatePointServiceEloquentRepository implements CoordinatePointServiceRepositoryContract
{
    protected $coordinatePointService;

    public function __construct(CoordinatePointService $coordinatePointService)
    {
        $this->coordinatePointService=$coordinatePointService;
    }

    public function all($search='')
    {
        return $this->coordinatePointService->where('name', 'like', '%' . $search . '%')->orderBy('name')->get();
    }

    public function findById($id)
    {
        return $this->coordinatePointService->findOrFail($id);
    }

    public function create(array $data)
    {
        return $this->coordinatePointService->create($data);
    }

    public function update(array $data, $id)
    {
        $coordinatePointService = $this->coordinatePointService->findOrFail($id);
        $coordinatePointService->setOldAttributes($coordinatePointService->getAttributes());
        $coordinatePointService->update($data);
        return $coordinatePointService;
    }

    public function destroy($id)
    {
        $coordinatePointService = $this->coordinatePointService->findOrFail($id);
        $coordinatePointService->is_active = 0;
        $coordinatePointService->save();
        return $coordinatePointService;
    }

    public function paginate($perPage = 30)
    {
        return $this->coordinatePointService->orderBy('name')->paginate($perPage);
    }
}