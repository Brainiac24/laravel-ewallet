<?php

namespace App\Models\Currency\CurrencyRateCategory;

use App\Models\BaseModel;

class CurrencyRateCategory extends BaseModel
{
    protected $fillable = [
        'id', 
        'code', 
        'name',
        'desc',
        'is_active',
    ];
}
