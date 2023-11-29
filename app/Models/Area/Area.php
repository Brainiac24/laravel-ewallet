<?php

namespace App\Models\Area;

use App\Models\BaseModel;
use App\Services\Common\Filter\Filterable;

class Area extends BaseModel
{
    use Filterable;

    protected $fillable = [
        'id',
        'code',
        'code_map',
        'name',
        'desc',
        'region_id',
        'is_active',
    ];

    public function region()
    {
        return $this->belongsTo('App\Models\Region\Region');
    }
}
