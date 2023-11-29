<?php

namespace App\Models\PurposeType;

use App\Models\BaseModel;
use App\Services\Common\Filter\Filterable;

class PurposeType extends BaseModel
{
    use Filterable;
    //
    protected $fillable = [
        'id',
        'code',
        'name',
        'is_active',
    ];
}