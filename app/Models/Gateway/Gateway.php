<?php

namespace App\Models\Gateway;

use App\Models\BaseModel;
use App\Services\Common\Filter\Filterable;


/**
 * App\Models\Gateway\Gateway
 *
 * @property string $id
 * @property string $code
 * @property string $name
 * @property string|null $params_json
 * @property int $is_active
 * @property int $is_enabled_for_account
 * @property int $is_enabled_for_service
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Gateway\Gateway whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Gateway\Gateway whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Gateway\Gateway whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Gateway\Gateway whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Gateway\Gateway whereIsEnabledForAccount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Gateway\Gateway whereIsEnabledForService($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Gateway\Gateway whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Gateway\Gateway whereParamsJson($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Gateway\Gateway whereUpdatedAt($value)
 * @mixin \Eloquent
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Gateway\Gateway filterBy(\App\Services\Common\Filter\QueryFilter $queryFilter)
 */
class Gateway extends BaseModel
{
    use Filterable;

    protected $casts = [
        'debet_json' => 'array',
        'credit_json' => 'array',
    ];

    protected $fillable = [
        'code',
        'name',
        'params_json',
        'is_active',
        'is_enabled_for_account',
        'is_enabled_for_service',
        'debet_json',
        'credit_json',
    ];
}