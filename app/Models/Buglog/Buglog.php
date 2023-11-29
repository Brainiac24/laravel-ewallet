<?php

namespace App\Models\Buglog;


use App\Models\BaseModel;
use App\Services\Common\Filter\Filterable;

/**
 * App\Models\Buglog\Buglog
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Buglog\Buglog filterBy(\App\Services\Common\Filter\QueryFilter $queryFilter)
 * @mixin \Eloquent
 */
class Buglog extends BaseModel
{
    use Filterable;

    protected $fillable = [
        'tag',
        'link',
        'responce',
        'error',
        'token',
        'os',
        'version',
        'msisdn',
    ];
}
