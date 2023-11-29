<?php

namespace App\Models\Purpose;

use App\Models\BaseModel;
use App\Models\PurposeType\PurposeType;
use App\Services\Common\Filter\Filterable;
use Illuminate\Database\Eloquent\Model;

class Purpose extends BaseModel
{
    use Filterable;
    //
    protected $fillable = [
        'code',
        'code_map',
        'name',
        'desc',
        'is_active',
    ];

    public function purpose_type()
    {
        return $this->belongsTo(PurposeType::class);
    }


}
