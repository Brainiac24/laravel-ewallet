<?php

namespace App\Models\Service\CommissionData;

use App\Models\BaseModel;
use App\Models\Service\Commission\Commission;


/**
 * App\Models\Service\CommissionData\CommissionData
 *
 * @property string $id
 * @property float $min
 * @property float $max
 * @property float $value
 * @property int $is_persentage
 * @property string $commission_id
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \App\Models\Service\Commission\Commission $commissions
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Service\CommissionData\CommissionData whereCommissionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Service\CommissionData\CommissionData whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Service\CommissionData\CommissionData whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Service\CommissionData\CommissionData whereIsPersentage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Service\CommissionData\CommissionData whereMax($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Service\CommissionData\CommissionData whereMin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Service\CommissionData\CommissionData whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Service\CommissionData\CommissionData whereValue($value)
 * @mixin \Eloquent
 */
class CommissionData extends BaseModel
{   

    protected $table = 'commission_data';

    public function commissions()
    {
        return $this->belongsTo(Commission::class);
    }
    protected $fillable = [
        'min',
        'max',
        'value',
        'is_persentage',
        'commission_id',
    ];
}
