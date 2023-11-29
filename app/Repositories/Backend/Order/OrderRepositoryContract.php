<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 01.08.2019
 * Time: 15:21
 */

namespace App\Repositories\Backend\Order;


interface OrderRepositoryContract
{
    public function paginate($data = [], $perPage = 30, $columns = ['*']);

    public function findById($id);

    public function update(array $data, $id);

    public function getAllByWillContinueProcess();
}