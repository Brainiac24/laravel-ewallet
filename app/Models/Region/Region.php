<?php

namespace App\Models\Region;

use App\Models\BaseModel;
use App\Services\Common\Filter\Filterable;

class Region extends BaseModel
{
    use Filterable;

    protected $fillable = [
        'id',
        'code',
        'code_map',
        'name',
        'desc',
        'country_id',
        'is_active',
    ];

    public function country()
    {
        return $this->belongsTo('App\Models\Country\Country');
    }
}
