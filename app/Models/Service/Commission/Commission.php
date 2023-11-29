<?php

namespace App\Models\Service\Commission;

use App\Models\BaseModel;

/**
 * App\Models\Service\Commission\Commission
 *
 * @property string $id
 * @property string $name
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read mixed $params_json
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Service\Commission\Commission whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Service\Commission\Commission whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Service\Commission\Commission whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Service\Commission\Commission whereUpdatedAt($value)
 * @mixin \Eloquent
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Service\Commission\Commission whereParamsJson($value)
 */
class Commission extends BaseModel
{
    protected $fillable = [
        'name',
        'params_json',
    ];

    protected $casts = [
        'params_json' => 'array'
    ];

    public function getParamsJsonAttribute()
    {
        return empty($this->attributes['params_json']) ? [] : json_decode($this->attributes['params_json'], true);
    }
}
