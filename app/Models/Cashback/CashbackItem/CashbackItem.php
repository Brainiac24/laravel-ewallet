<?php
/**
 * Created by PhpStorm.
 * User: Ladmin
 * Date: 20.12.2019
 * Time: 14:26
 */

namespace App\Models\Cashback\CashbackItem;


use App\Models\BaseModel;
use App\Models\Cashback\Cashback;
use App\Services\Common\Filter\Filterable;

class CashbackItem extends BaseModel
{
    use Filterable;

    protected $fillable = [
        'name',
        'min',
        'max',
        'value',
        'is_percentage',
        'cashback_id',
        'is_active',
    ];

    public function cashback()
    {
        return $this->belongsTo(Cashback::class);
    }
}