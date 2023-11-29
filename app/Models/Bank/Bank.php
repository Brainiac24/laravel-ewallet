<?php

namespace App\Models\Bank;

use App\Models\BaseModel;
use App\Services\Common\Filter\Filterable;

class Bank extends BaseModel
{
    use Filterable;
    //
    protected $fillable = [
        'id',
        'code',
        'code_map',
        'name',
        'desc',
        'bic',
        'corr_acc',
        'position',
        'is_active',
    ];
}
