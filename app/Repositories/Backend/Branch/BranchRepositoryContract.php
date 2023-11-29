<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 19.06.2019
 * Time: 10:37
 */

namespace App\Repositories\Backend\Branch;


interface BranchRepositoryContract
{
    public function all($search);

    public function update(array $data, $id);

    public function create(array $data);

    public function getById($id);

    public function paginate($perPage, $columns);
}