<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 23.07.2019
 * Time: 17:56
 */

namespace App\Repositories\Backend\CategoryType;


interface CategoryTypeRepositoryContract
{
    public function all($columns = ['*']);

    public function paginate($perPage = 30, $columns = ['*']);

    public function findById($id);

    public function update(array $data, $id);
}