<?php

namespace App\Models\OrderCardType;

use App\Models\BaseModel;
use App\Models\Currency\Currency;
use App\Services\Common\Filter\Filterable;

class OrderCardType extends BaseModel
{
    use Filterable;
    protected $casts = [
        'html_params_json' => 'array',
    ];

    protected $fillable = [
        'id',
        'code',
        'code_map',
        'name',
        'price',
        'insurance_price',
        'code_ibank',
        'year',
        'icon',
        'information',
        'detail',
        'position',
        'currency_id',
        'html_params_json',
        'order_card_contract_type_id',
        'is_active',
    ];

    public function currency()
    {
        return $this->belongsTo(Currency::class,'currency_id');
    }
}
