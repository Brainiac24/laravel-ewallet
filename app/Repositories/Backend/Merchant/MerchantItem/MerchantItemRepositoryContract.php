<?php
/**
 * Created by PhpStorm.
 * User: Ladmin
 * Date: 04.11.2019
 * Time: 14:05
 */

namespace App\Repositories\Backend\Merchant\MerchantItem;


interface MerchantItemRepositoryContract
{
    public function all($search);

    public function paginate($data = [], $perPage = 30, $columns = ['*']);

    public function findById($id);

    public function findByMerchantId($merchant_id);

    public function GetAllByMerchantId($id);

    public function findByIdWithoutAccount($id);

    public function findByIdWithoutGlobal($id);

    public function update(array $data, $id);

    public function destroy($id);

    public function create(array $data);

    public function updateAccountNumber($id, $account_number);

    public function findByAccountIdWithoutGlobal($id);

    public function generateHash($id);

    public function generateSettingsJson($id);
}