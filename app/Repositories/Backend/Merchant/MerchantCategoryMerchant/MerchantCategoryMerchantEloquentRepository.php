<?php
/**
 * Created by PhpStorm.
 * User: Ladmin
 * Date: 31.12.2019
 * Time: 13:20
 */

namespace App\Repositories\Backend\Merchant\MerchantCategoryMerchant;

use App\Models\Merchant\MerchantCategoryMerchant\MerchantCategoryMerchant;

class MerchantCategoryMerchantEloquentRepository implements MerchantCategoryMerchantRepositoryContract
{
    /**
     * @var MerchantCategoryMerchant
     */
    private $merchantCategoryMerchant;

    /**
     * MerchantCategoryMerchantEloquentRepository constructor.
     * @param MerchantCategoryMerchant $merchantCategoryMerchant
     */
    public function __construct(MerchantCategoryMerchant $merchantCategoryMerchant)
    {
        $this->merchantCategoryMerchant = $merchantCategoryMerchant;
    }

    public function all($columns = ['*'])
    {
        return $this->merchantCategoryMerchant->get();
    }

    public function create(array $data)
    {
        return $this->merchantCategoryMerchant->create($data);
    }

    public function GetAllByMerchantId($merchant_id)
    {
        return $this->merchantCategoryMerchant->where('merchant_id',$merchant_id)->get();
    }

    public function findById($id)
    {
        return $this
            ->merchantCategoryMerchant
            ->where('id', $id)
            ->first();
    }
}