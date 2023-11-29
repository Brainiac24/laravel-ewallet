<?php

namespace App\Models\OrderCardContractType;

use App\Models\BaseModel;

class OrderCardContractType extends BaseModel
{
    protected $fillable = [
        'id',
        'code_map',
        'name',
        'percentage',
        'month',
        'is_active',
    ];
}
