<?php

namespace App\Repositories\Backend\Region;

use App\Models\Country\Country;
use App\Models\Region\Filters\RegionFilter;
use App\Repositories\Backend\Region\RegionRepositoryContract;
use App\Models\Region\Region;

class RegionEloquentRepository implements RegionRepositoryContract
{

    protected $region;
    /**
     * @var Country
     */
    private $country;

    public function __construct(Region $region, Country $country)
    {
        $this->region = $region;
        $this->country = $country;
    }

    public function all($search, $data=[])
    {
        return $this->region->where('name', 'like', '%' . $search . '%')->filterBy(new RegionFilter($data))->orderBy('name')->get();
    }

    public function getIdByCodeMap($code)
    {
        $item = $this->region->where('code_map', $code)->first();
        return $item != null ? $item->id : null;
    }

    public function getById($id)
    {
        return $this->region->where('id', $id)->first();
    }
    
    public function listsAll($data = [])
    {
        return $this->region->orderBy('name')->filterBy(new RegionFilter($data))->orderBy('name')->get()->pluck('name', 'id');
    }

    public function getAllWithCountry($perPage = 30)
    {
        return $this->region->with('country')->paginate($perPage);
    }

    public function getByIdWithCountry($id)
    {
        return $this->region->with('country')->where('id',$id)->first();
    }

//    public function getCountry()
//    {
//        return $this->country->orderBy('name')->get()->pluck('name', 'id');
//    }

    public function getCountryById($country_id)
    {
        return $this->country->where('id',$country_id)->orderBy('name')->get()->pluck('id');
    }

    public function getRegionsByCountyId($countryId)
    {
        return $this->region->where('country_id',$countryId)->orderBy('name')->get()->pluck('name', 'id');
    }

    public function update(array $data, $id)
    {
        $region = $this->region->findOrFail($id);
        $region->setOldAttributes($region->getAttributes());
        $region->update($data);
        return $region;
    }

    public function destroy($id)
    {
        $region = $this->region->findOrFail($id);
        $region->is_active = 0;
        $region->save();
        return $region;
    }

    public function create(array $data)
    {
        return $this->region->create($data);
    }
}