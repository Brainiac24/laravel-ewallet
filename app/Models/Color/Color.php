<?php

namespace App\Models\Color;

use App\Models\BaseModel;

class Color extends BaseModel
{
    //
    protected $fillable = [
        'id',
        'code',
        'color',
        'is_active',
    ];
}
