<?php
/**
 * Created by PhpStorm.
 * User: Ladmin
 * Date: 27.09.2019
 * Time: 10:07
 */

namespace App\Repositories\Backend\News;


interface NewsRepositoryContract
{
    public function all($search);

    public function paginate($data = [], $perPage = 30, $columns = ['*']);

    public function findById($id);

    public function update(array $data, $id);

    public function destroy($id);

    public function create(array $data);

    public function deleteImage($id);
}