<?php

namespace App\Repositories\Backend\Area;

use App\Models\Area\Filters\AreaFilter;
use App\Models\Country\Country;
use App\Models\Region\Region;
use App\Repositories\Backend\Area\AreaRepositoryContract;
use App\Models\Area\Area;

class AreaEloquentRepository implements AreaRepositoryContract
{

    protected $area;
    /**
     * @var Region
     */
    private $region;
    /**
     * @var Country
     */
    //private $country;

    public function __construct(Area $area, Region $region)
    {
        $this->area = $area;
        $this->region = $region;
        //$this->country = $country;
    }

    public function all($search, $data = [])
    {
        return $this->area->where('name', 'like', '%' . $search . '%')->filterBy(new AreaFilter($data))->orderBy('name')->get();
    }

    public function getIdByCodeMap($code)
    {
        $item = $this->area->where('code_map', $code)->first();
        return $item != null ? $item->id : null;
    }

    public function getById($id)
    {
        return $this->area->where('id', $id)->first();
       // return $this->area->with('user')->where('id', $id)->first();
    }

    public function listsAll($data = [])
    {
        return $this->area->orderBy('name')->filterBy(new AreaFilter($data))->orderBy('name')->get()->pluck('name', 'id');
    }

    public function getAllWithRegion($perPage=30)
    {
        return $this->area->
        with('region.country')->
        paginate($perPage);
    }

    public function getByIdWithRegion($id)
    {
        return $this->area->with('region.country')->where('id', $id)->first();
    }

//    public function getRegion()
//    {
//        return $this->region->orderBy('name')->get()->pluck('name', 'id');
//    }

    public function update(array $data, $id)
    {
        $area = $this->area->findOrFail($id);
        $area->setOldAttributes($area->getAttributes());
        $area->update($data);
        return $area;
    }

    public function destroy($id)
    {
        $area = $this->area->findOrFail($id);
        $area->is_active = 0;
        $area->save();
        return $area;
    }

    public function create(array $data)
    {
        return $this->area->create($data);
    }

//    public function getCountry()
//    {
//        return $this->country->orderBy('name')->get()->pluck('name', 'id');
//    }

    public function getAreasByRegionId($regionId)
    {
        return $this->area->where('region_id',$regionId)->orderBy('name')->get()->pluck('name', 'id');
    }

    public function getByRegionIdWithCountry($regionId)
    {
        return $this->region->with('country')->where('id',$regionId)->first();
    }

}