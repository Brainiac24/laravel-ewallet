<?php
/**
 * Created by PhpStorm.
 * User: Ladmin
 * Date: 24.02.2020
 * Time: 10:10
 */

namespace App\Models\Merchant\MerchantCommissionItem;


use App\Models\BaseModel;
use App\Models\Merchant\MerchantCommission\MerchantCommission;
use App\Services\Common\Filter\Filterable;

class MerchantCommissionItem extends BaseModel
{
    use Filterable;

    protected $fillable = [
        'id',
        'name',
        'min',
        'max',
        'value',
        'is_percentage',
        'merchant_commission_id',
        'is_active',
        'created_at',
        'updated_at',
    ];

    public function merchant_commission()
    {
        return $this->belongsTo(MerchantCommission::class);
    }
}