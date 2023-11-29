<?php

namespace App\Models\Country;

use App\Models\BaseModel;

class Country extends BaseModel
{
    protected $fillable = [
        'id',
        'code',
        'code_map',
        'iso_2',
        'iso_3',
        'name',
        'desc',
        'is_active',
    ];
}
