<?php
/**
 * Created by PhpStorm.
 * User: Ladmin
 * Date: 24.02.2020
 * Time: 10:07
 */

namespace App\Models\Merchant\MerchantCommission;


use App\Models\BaseModel;
use App\Services\Common\Filter\Filterable;

class MerchantCommission extends BaseModel
{
    use Filterable;

    protected $fillable = [

        'name',
        'start_date',
        'end_date',
        'is_active',
        'created_at',
        'updated_at',
    ];
}