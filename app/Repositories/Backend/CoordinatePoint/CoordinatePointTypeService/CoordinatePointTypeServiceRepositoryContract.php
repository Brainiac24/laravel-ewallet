<?php


namespace App\Repositories\Backend\CoordinatePoint\CoordinatePointTypeService;


interface CoordinatePointTypeServiceRepositoryContract
{
    public function all($search);

    public function findById($id);

    public function create(array $data);

    public function update(array $data, $id);

    public function destroy($id);

    public function paginate($perPage = 30);

    public function GetAllByTypeId($coordinate_point_type_id);
}