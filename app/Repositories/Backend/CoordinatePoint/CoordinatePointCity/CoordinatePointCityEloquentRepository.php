<?php


namespace App\Repositories\Backend\CoordinatePoint\CoordinatePointCity;



use App\Models\CoordinatePoint\CoordinatePointCity\CoordinatePointCity;

class CoordinatePointCityEloquentRepository implements CoordinatePointCityRepositoryContract
{
    protected $coordinatePointCity;

    public function __construct(CoordinatePointCity $coordinatePointCity)
    {
        $this->coordinatePointCity= $coordinatePointCity;
    }
    public function all($search='')
    {
        return $this->coordinatePointCity->get();
    }

    public function findById($id)
    {
        return $this->coordinatePointCity->findOrFail($id);
    }

    public function create(array $data)
    {
        return $this->coordinatePointCity->create($data);
    }

    public function update(array $data, $id)
    {
        $coordinatePointCity = $this->coordinatePointCity->findOrFail($id);
        $coordinatePointCity->setOldAttributes($coordinatePointCity->getAttributes());
        $coordinatePointCity->update($data);
        return $coordinatePointCity;
    }

    public function destroy($id)
    {
        $coordinatePointCity = $this->coordinatePointCity->findOrFail($id);
        $coordinatePointCity->is_active = 0;
        $coordinatePointCity->save();
        return $coordinatePointCity;
    }

    public function paginate($perPage = 30)
    {
        return $this->coordinatePointCity->with('city')->paginate($perPage);
    }

    public function updateVersions($ids)
    {
        $coordinatePointCities = $this->coordinatePointCity->whereIn('id', $ids)->get();
        foreach ($coordinatePointCities as  $coordinatePointCity){
            $coordinatePointCity->version += 1;
            $coordinatePointCity->save();
        }
    }
}