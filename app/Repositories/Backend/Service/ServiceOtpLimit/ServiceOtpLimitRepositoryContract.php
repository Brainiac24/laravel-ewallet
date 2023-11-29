<?php
/**
 * Created by PhpStorm.
 * User: Ladmin
 * Date: 11.10.2019
 * Time: 9:32
 */

namespace App\Repositories\Backend\Service\ServiceOtpLimit;


interface ServiceOtpLimitRepositoryContract
{
    public function all($search);

    public function listsAll();

    public function paginate($data = [], $perPage = 30, $columns = ['*']);

    public function findById($id);

    public function update(array $data, $id);

    public function destroy($id);

    public function create(array $data);
}