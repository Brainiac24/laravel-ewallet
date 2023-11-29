<?php

namespace App\Models\User\Attestation;

use App\Models\BaseModel;
use App\Services\Common\Traits\UuidModel;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\User\Attestation\Attestation
 *
 * @property string $id
 * @property string $code
 * @property string $name
 * @property float $day_limit
 * @property float $week_limit
 * @property float $month_limit
 * @property float $balance
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User\Attestation\Attestation whereBalance($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User\Attestation\Attestation whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User\Attestation\Attestation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User\Attestation\Attestation whereDayLimit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User\Attestation\Attestation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User\Attestation\Attestation whereMonthLimit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User\Attestation\Attestation whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User\Attestation\Attestation whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User\Attestation\Attestation whereWeekLimit($value)
 * @mixin \Eloquent
 * @property float $balance_limit
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User\Attestation\Attestation whereBalanceLimit($value)
 * @property array $params_json
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User\Attestation\Attestation whereParamsJson($value)
 */
class Attestation extends BaseModel
{

    protected $casts = [
        'params_json' => 'array',
        'info_params_json' => 'array',
    ];

    protected $fillable = [
        'code',
        'name',
        'params_json',
        'info_params_json',
    ];
}
