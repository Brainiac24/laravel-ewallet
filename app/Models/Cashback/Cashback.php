<?php
/**
 * Created by PhpStorm.
 * User: Ladmin
 * Date: 17.12.2019
 * Time: 17:29
 */

namespace App\Models\Cashback;


use App\Models\BaseModel;
use App\Services\Common\Filter\Filterable;

class Cashback extends BaseModel
{
    use Filterable;

    protected $fillable = [
        'name',
        'start_date',
        'end_date',
        'is_active',
    ];
}