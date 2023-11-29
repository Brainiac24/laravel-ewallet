<?php

namespace App\Models\Cashback\BonusAccrual\BonusAccrualStatus;

use App\Models\BaseModel;

class BonusAccrualStatus extends BaseModel
{
    protected $fillable = [
        'id',
        'code',
        'name',
        'is_active',
    ];
}
