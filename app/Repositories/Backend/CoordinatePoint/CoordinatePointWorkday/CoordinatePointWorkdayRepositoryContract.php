<?php


namespace App\Repositories\Backend\CoordinatePoint\CoordinatePointWorkday;


interface CoordinatePointWorkdayRepositoryContract
{
    public function all($search='');

    public function findById($id);

    public function create(array $data);

    public function update(array $data, $id);

    public function destroy($id);

    public function paginate($perPage = 30);
}