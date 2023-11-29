<?php

namespace App\Repositories\Backend\Area;

interface AreaRepositoryContract
{
    public function all($search);

    public function getAllWithRegion($perPage=30);

    public function getByIdWithRegion($id);

    //public function getRegion();

    public function update(array $data, $id);

    public function create(array $data);

    //public function getCountry();

    public function getAreasByRegionId($regionId);

    public function getByRegionIdWithCountry($regionId);

    public function getById($id);
}