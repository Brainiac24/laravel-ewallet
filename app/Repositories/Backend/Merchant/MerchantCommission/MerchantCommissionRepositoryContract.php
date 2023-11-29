<?php
/**
 * Created by PhpStorm.
 * User: Ladmin
 * Date: 24.02.2020
 * Time: 10:13
 */

namespace App\Repositories\Backend\Merchant\MerchantCommission;


interface MerchantCommissionRepositoryContract
{
    public function all($search);

    public function paginate($data = [], $perPage = 30, $columns = ['*']);

    public function findById($id);

    public function update(array $data, $id);

    public function destroy($id);

    public function create(array $data);
}