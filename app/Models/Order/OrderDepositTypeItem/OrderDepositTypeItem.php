<?php

namespace App\Models\Order\OrderDepositTypeItem;

use App\Models\BaseModel;
use App\Models\Currency\Currency;
use App\Models\Order\OrderDepositType\OrderDepositType;
use App\Services\Common\Filter\Filterable;

class OrderDepositTypeItem extends BaseModel
{
    use Filterable;
    //
    protected $fillable = [
        'id',
        'code',
        'code_map',
        'name',
        'min_amount',
        'max_amount',
        'day_from_count',
        'day_to_count',
        'percentage',
        'can_fill_until',
        'can_fill_until_is_persentage',
        'currency_id',
        'order_deposit_type_id',
        'position',
        'is_fillable',
        'is_withdrawable',
        'is_active',
    ];

    public function order_deposit_type()
    {
        return $this->belongsTo(OrderDepositType::class);
    }

    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }
}
