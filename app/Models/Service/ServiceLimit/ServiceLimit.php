<?php

namespace App\Models\Service\ServiceLimit;

use App\Models\BaseModel;


/**
 * App\Models\Service\ServiceLimit\ServiceLimit
 *
 * @property string $id
 * @property string $code
 * @property string $name
 * @property float $day_limit
 * @property float $week_limit
 * @property float $month_limit
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Service\ServiceLimit\ServiceLimit whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Service\ServiceLimit\ServiceLimit whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Service\ServiceLimit\ServiceLimit whereDayLimit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Service\ServiceLimit\ServiceLimit whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Service\ServiceLimit\ServiceLimit whereMonthLimit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Service\ServiceLimit\ServiceLimit whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Service\ServiceLimit\ServiceLimit whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Service\ServiceLimit\ServiceLimit whereWeekLimit($value)
 * @mixin \Eloquent
 * @property array|null $params_json
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Service\ServiceLimit\ServiceLimit whereParamsJson($value)
 */
class ServiceLimit extends BaseModel
{

    protected $casts = [
        'params_json' => 'array',
        'extend_params_json' => 'array',
    ];

    protected $fillable = [
        'code',
        'name',
        'params_json',
        'extend_params_json',
    ];
}
