<?php

namespace App\Repositories\Backend\Region;

interface RegionRepositoryContract
{
    public function all($search);

    public function getById($id);

    public function getAllWithCountry($perPage = 30);

    public function getByIdWithCountry($id);

    //public function getCountry();

    //public function getCountryById($country_id);

    public function getRegionsByCountyId($country_id);

    public function update(array $data, $id);

    public function destroy($id);

    public function create(array $data);
}