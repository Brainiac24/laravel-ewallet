<?php

namespace App\Models\CoordinatePoint;

use App\Models\BaseModel;
use App\Models\CoordinatePoint\CoordiantePointType\CoordinatePointType;
use App\Models\CoordinatePoint\CoordinatePointCity\CoordinatePointCity;
use App\Models\CoordinatePoint\CoordinatePointWorkday\CoordinatePointWorkday;
use App\Models\Merchant\Merchant;
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
 * @property string $latitude
 * @property string $longitude
 * @property string $address
 * @property int $object_type
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CoordinatePoint\CoordinatePoint filterBy(\App\Services\Common\Filter\QueryFilter $queryFilter)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CoordinatePoint\CoordinatePoint whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CoordinatePoint\CoordinatePoint whereLatitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CoordinatePoint\CoordinatePoint whereLongitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CoordinatePoint\CoordinatePoint whereObjectType($value)
 */
class CoordinatePoint extends BaseModel
{
    use Filterable;
    protected $fillable = [
        'latitude',
        'longitude',
        'name',
        'address',
        'is_active',
        'object_type',
        'coordinate_point_workday_id',
        'coordinate_point_type_id',
        'merchant_id',
        'coordinate_point_city_id',
    ];

    public function merchant()
    {
        return $this->belongsTo(Merchant::class, 'merchant_id')->withDefault();
    }

    public function coordinate_point_type()
    {
        return $this->belongsTo(CoordinatePointType::class, 'coordinate_point_type_id')->withDefault();
    }

    public function coordinate_point_workday()
    {
        return $this->belongsTo(CoordinatePointWorkday::class, 'coordinate_point_workday_id')->withDefault();
    }

    public function coordinate_point_city()
    {
        return $this->belongsTo(CoordinatePointCity::class, 'coordinate_point_city_id')->withDefault();
    }
}