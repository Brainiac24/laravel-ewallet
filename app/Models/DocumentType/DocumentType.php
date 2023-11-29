<?php

namespace App\Models\DocumentType;

use App\Models\BaseModel;
use App\Services\Common\Filter\Filterable;

class DocumentType extends BaseModel
{
    //
    use Filterable;
    //
    protected $fillable = [
        'id',
        'code',
        'code_map',
        'name',
        'desc',
        'is_active',
    ];
}
