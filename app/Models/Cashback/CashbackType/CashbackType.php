<?php

namespace App\Models\Cashback\CashbackType;

use App\Models\BaseModel;

class CashbackType extends BaseModel
{
    protected $fillable = [
        'id',
        'code',
        'name',
        'is_active',
    ];
}
