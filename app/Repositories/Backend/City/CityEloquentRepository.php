<?php

namespace App\Repositories\Backend\City;

use App\Models\City\City;
use App\Models\City\Filters\CityFilter;
use App\Repositories\Backend\City\CityRepositoryContract;

class CityEloquentRepository implements CityRepositoryContract
{

    protected $city;

    public function __construct(City $city)
    {
        $this->city = $city;
    }

    public function all($search, $data = [])
    {
        return $this->city->where('name', 'like', '%' . $search . '%')->filterBy(new CityFilter($data))->orderBy('name')->get();
    }

    public function findById($id)
    {
        return $this->city->where('id', $id)->first();
    }

    public function getIdByCodeMap($code)
    {
        $item = $this->city->where('code_map', $code)->first();
        return $item != null ? $item->id : null;
    }

    public function getById($id)
    {
        return $this->city->with('user')->where('id', $id)->first();
    }

    public function listsAll($data = [])
    {
        return $this->city->orderBy('name')->filterBy(new CityFilter($data))->orderBy('name')->get()->pluck('name', 'id');
    }

    public function paginate($data = [], $perPage = 30, $columns = ['*'])
    {
        return $this->city->select($columns)->withoutGlobalScopes()->with('area')->paginate($perPage);//->filterBy(new AccountFilter($data))->paginate($perPage);
    }

    public function getWithRelation($perPage=30)
    {
        return $this->city->with('area.region.country')->paginate($perPage);
    }

    public function getByIdWithRelation($id)
    {
        return $this->city->with('area.region.country')->where('id',$id)->first();
    }

    public function update(array $data, $id)
    {
        $city = $this->city->findOrFail($id);
        $city->setOldAttributes($city->getAttributes());
        $city->update($data);
        return $city;
    }

    public function destroy($id)
    {
        $city = $this->city->findOrFail($id);
        $city->is_active = 0;
        $city->save();
        return $city;
    }

    public function create(array $data)
    {
        return $this->city->create($data);
    }

    public function getCitiesByAreaId($areaId)
    {
        return $this->city->where('area_id', $areaId)->orderBy('name')->get()->pluck('name', 'id');
    }
}
