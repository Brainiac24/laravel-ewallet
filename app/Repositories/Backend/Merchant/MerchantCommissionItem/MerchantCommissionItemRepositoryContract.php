<?php
/**
 * Created by PhpStorm.
 * User: Ladmin
 * Date: 24.02.2020
 * Time: 10:30
 */

namespace App\Repositories\Backend\Merchant\MerchantCommissionItem;


interface MerchantCommissionItemRepositoryContract
{
    public function all($search);

    public function paginate($data = [], $perPage = 30, $columns = ['*']);

    public function findById($id);

    public function findByMerchantCommissionId($merchant_commission_id);

    public function GetAllMerchantCommissionById($merchant_commission_id);

    public function GetMaxValueFromColumnMaxByMerchantCommissionId($merchant_commission_id);

    public function update(array $data, $id);

    public function destroy($id);

    public function create(array $data);
}