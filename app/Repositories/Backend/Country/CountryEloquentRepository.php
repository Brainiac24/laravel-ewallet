<?php

namespace App\Repositories\Backend\Country;

use App\Repositories\Backend\Country\CountryRepositoryContract;
use App\Models\Country\Country;

class CountryEloquentRepository implements CountryRepositoryContract
{

    protected $country;

    public function __construct(Country $country)
    {
        $this->country = $country;
    }

    public function all($search)
    {
        return $this->country->where('name', 'like', '%' . $search . '%')->orderBy('name')->get();
    }

    public function getIdByCodeMap($code)
    {
        $item = $this->country->where('code_map', $code)->first();
        return $item != null ? $item->id : null;
    }

    public function create(array $data)
    {
        return $this->country->create($data);
    }

    public function update(array $data, $id)
    {
        $country = $this->country->findOrFail($id);
        $country->setOldAttributes($country->getAttributes());
        $country->update($data);
        return $country;
    }

    public function getById($id)
    {
        return $this->country->where('id', $id)->get();
    }

    public function findById($id)
    {
        return $this->country->where('id', $id)->first();
    }

    public function destroy($id)
    {
        $country = $this->country->findOrFail($id);
        $country->is_active = 0;
        $country->save();
        return $country;
    }

    public function paginate($perPage = 30)
    {
        return $this->country->orderBy('name')->paginate($perPage);
    }

    public function listsAll()
    {
        return $this->country->orderBy('name')->get()->pluck('name', 'id');
    }
}

//    public function getByNamePluck($name)
//    {
//        return $this->country->where('name', $name)->get()->pluck('name', 'id');
//    }

//<<<<<<< HEAD
//    public function findById($id)
//    {
//        return $this->country->where('id', $id)->first();
//    }
//
//    public function getByIdPluck($id)
//=======
//    public function getByNamePluck($name)
//>>>>>>> 1b33625bca6781ef610603390821cadbe2340678
//    {
//        return $this->country->where('name', $name)->get()->pluck('name', 'id');
//    }
//

//    public function destroy($id)
//    {
//        $country = $this->country->findOrFail($id);
//        $country->is_active = 0;
//        $country->save();
//        return $country;
//    }
//
//    public function paginate($perPage = 30)
//    {
//        return $this->country->orderBy('name')->paginate($perPage);
//    }
//}