<?php

namespace App\Models\City;

use App\Models\BaseModel;
use App\Services\Common\Filter\Filterable;

class City extends BaseModel
{
    use Filterable;

    protected $fillable = [
        'id',
        'code',
        'code_map',
        'name',
        'desc',
        'area_id',
        'is_active'
    ];

    public function area()
    {
        return $this->belongsTo('App\Models\Area\Area');
    }
}
