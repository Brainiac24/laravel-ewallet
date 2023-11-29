<?php

namespace App\Models\CategoryType;

use App\Models\BaseModel;
use App\Services\Common\Filter\Filterable;
use Illuminate\Database\Eloquent\Model;

class CategoryType extends BaseModel
{
    //
    use Filterable;
    protected $fillable = [
        'id',
        'code',
        'name',
        'is_active',
        'position'
    ];
}
