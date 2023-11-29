<?php

namespace App\Models\AccountCategoryType;

use App\Models\BaseModel;

class AccountCategoryType extends BaseModel
{
    protected $fillable = [
        'id',
        'code',
        'name',
        'img_uncolored',
        'img_colored',
        'position',
        'parent_id',
        'params_json',
    ];

    protected $casts = [
        'params_json' => 'array',
    ];
}
