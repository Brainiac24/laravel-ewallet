<?php
/**
 * Created by PhpStorm.
 * User: Ladmin
 * Date: 11.10.2019
 * Time: 9:29
 */

namespace App\Models\Service\ServiceOtpLimit;


use App\Models\BaseModel;
use App\Services\Common\Filter\Filterable;

class ServiceOtpLimit extends BaseModel
{
    use Filterable;

    protected $casts = [
        'params_json' => 'array',
    ];

    protected $fillable = [
        'Id',
        'code',
        'name',
        'params_json'
    ];
}