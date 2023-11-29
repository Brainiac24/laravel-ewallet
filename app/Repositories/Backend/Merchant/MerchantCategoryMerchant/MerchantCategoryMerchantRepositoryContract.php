<?php
/**
 * Created by PhpStorm.
 * User: Ladmin
 * Date: 31.12.2019
 * Time: 13:19
 */

namespace App\Repositories\Backend\Merchant\MerchantCategoryMerchant;


interface MerchantCategoryMerchantRepositoryContract
{
    public function all($columns = ['*']);

    public function findById($id);

    public function create(array $data);

    public function GetAllByMerchantId($merchant_id);
}