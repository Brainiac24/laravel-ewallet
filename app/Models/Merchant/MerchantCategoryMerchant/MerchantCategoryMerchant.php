<?php
/**
 * Created by PhpStorm.
 * User: Ladmin
 * Date: 31.12.2019
 * Time: 13:06
 */

namespace App\Models\Merchant\MerchantCategoryMerchant;


use App\Models\BaseModel;
use App\Services\Common\Filter\Filterable;

class MerchantCategoryMerchant extends BaseModel
{
    use Filterable;

    public $table = "merchant_category_merchant";

    protected $fillable = [
        //'id',
        'merchant_category_id',
        'merchant_id'
    ];
}