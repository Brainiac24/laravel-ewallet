<?php

namespace App\Models\Order\OrderAccountTypeItem;

use App\Models\BaseModel;
use App\Models\Currency\Currency;
use App\Models\Order\OrderAccountType\OrderAccountType;
use App\Services\Common\Filter\Filterable;

class OrderAccountTypeItem extends BaseModel
{
    use Filterable;
    //
    protected $fillable = [
        'id',
        'code',
        'code_map',
        'name',
        'currency_id',
        'order_account_type_id',
        'position',
        'is_active',
    ];

    public function order_account_type()
    {
        return $this->belongsTo(OrderAccountType::class);
    }
    
    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }
}
