<?php

namespace App\Models\Branch;

use App\Models\BaseModel;

class Branch extends BaseModel
{
    protected $fillable = [
        'id',
        'code',
        'code_map',
        'name',
        'branch_user_id',
        'is_active',
        'acc_number',
        'address',
        'params_json',
        'city_name',
    ];

    protected $casts = [
        'params_json' => 'array',
    ];
}
