<?php
/**
 * Created by PhpStorm.
 * User: Ladmin
 * Date: 17.12.2019
 * Time: 15:06
 */

namespace App\Models\Merchant\MerchantWorkdays;


use App\Models\BaseModel;
use App\Services\Common\Filter\Filterable;

class MerchantWorkdays extends BaseModel
{
    use Filterable;

    protected $fillable = [
        'name',
        'monday',
        'tuesday',
        'wednesday',
        'thursday',
        'friday',
        'saturday',
        'sunday',
    ];
}