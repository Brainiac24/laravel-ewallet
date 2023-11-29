<?php
/**
 * Created by PhpStorm.
 * User: Ladmin
 * Date: 17.12.2019
 * Time: 10:01
 */

namespace App\Repositories\Backend\Merchant\MerchantCategory;


interface MerchantCategoryRepositoryContract
{
    public function all($columns = ['*']);

    //public function paginate($data = [], $perPage = 30, $columns = ['*']);

    public function findById($id);

    public function update(array $data, $id);

    public function destroy($id);

    public function create(array $data);
}