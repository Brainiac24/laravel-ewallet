<?php
/**
 * Created by PhpStorm.
 * User: F_Kosimov
 * Date: 18.07.2018
 * Time: 15:10
 */

namespace App\Repositories\Backend\CoordinatePoint;

use App\Events\Backend\CoordinatePoint\CoordinatePointModifiedEvent;
use App\Models\CoordinatePoint\CoordinatePoint;
use App\Models\CoordinatePoint\Filters\CoordinatePointFilter;
use App\Services\Common\Helpers\CoordinatePoints\MatchCoordinatePointTypes;

class CoordinatePointEloquentRepository implements CoordinatePointRepositoryContract
{
    protected $coordinatePointRepository;

    public function __construct(CoordinatePoint $coordinatePointRepository)
    {

        $this->coordinatePointRepository = $coordinatePointRepository;

    }

    public function getForDataTable()
    {

    }

    public function all($columns = ['*'])
    {
        $coordinatePoints = $this->coordinatePointRepository->get($columns);
        return $coordinatePoints;
    }

    public function paginate($data = [], $perPage = 30, $columns = ['*'])
    {
        return $this->coordinatePointRepository
            ->select()
            ->filterBy(new CoordinatePointFilter($data))
            ->with('coordinate_point_workday',
                'merchant',
                'coordinate_point_type',
                'coordinate_point_city',
                'coordinate_point_city.city'
            )
            ->paginate($perPage);
    }

    public function listsAll()
    {
        return $this->coordinatePointRepository->get()->pluck('name', 'id');
    }

    public function create(array $data)
    {
        $data['object_type'] = MatchCoordinatePointTypes::getOldType($data['coordinate_point_type_id']);

        $coordinatePoint = $this->coordinatePointRepository->create($data);
        event(new CoordinatePointModifiedEvent($coordinatePoint));

        return $coordinatePoint;
    }

    public function findById($id, $columns = ['*'])
    {
        return $this->coordinatePointRepository->select($columns)->findOrFail($id);
    }

    public function update(array $data, $id)
    {
        $data['object_type'] = MatchCoordinatePointTypes::getOldType($data['coordinate_point_type_id']);
        $coordinatePoint = $this->coordinatePointRepository->findOrFail($id);
        $coordinatePoint->setOldAttributes($coordinatePoint->getAttributes());
        $coordinatePoint->update($data);

        foreach ($coordinatePoint->getOldAttributes() as $key => $oldAttribute) {
            if (isset($data[$key]) && $data[$key] != $oldAttribute && $key != 'updated_at'){
                event(new CoordinatePointModifiedEvent($coordinatePoint));
                return $coordinatePoint;
            }
        }

        return $coordinatePoint;
    }

    public function lastLoginUpdate($id)
    {

    }

    public function destroy($id)
    {
//        $this->coordinatePointRepository->findOrFail($id)->delete();
        $coordinatePointRepository = $this->coordinatePointRepository->findOrFail($id);
        $coordinatePointRepository->is_active = 0;
        $coordinatePointRepository->save();
        return $coordinatePointRepository;
        //return $this->coordinatePointRepository;
    }

    public function getIdByName($name)
    {
        return $this->coordinatePointRepository->where('name', $name)->first();
    }

}
