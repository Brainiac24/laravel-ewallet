<?php


namespace App\Repositories\Backend\Merchant\MerchantUser;


interface MerchantUserRepositoryContract
{
    public function all();

    public function paginate($data = [], $perPage = 30, $columns = ['*']);

    public function update(array $data, $id);

    public function findById($id);

    public function destroy($id);
}