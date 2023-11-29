<?php

namespace App\Repositories\Backend\City;

interface CityRepositoryContract
{
    public function all($search);
    public function paginate($data = [], $perPage = 30, $columns = ['*']);

    public function findById($id);

    public function getWithRelation($perPage=30);

    public function getByIdWithRelation($id);

    public function update(array $data, $id);

    public function destroy($id);

    public function create(array $date);

    public function getCitiesByAreaId($areaId);
}