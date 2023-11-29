<?php

namespace App\Models\Favorite;

use App\Models\Account\Scopes\OwnUserIdScope;
use App\Models\BaseModel;
use App\Models\Service\Service;
use App\Models\User\User;
use App\Services\Common\Filter\Filterable;
use App\Services\Common\Traits\UuidModel;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * App\Models\Favorite\Favorite
 *
 * @property string $id
 * @property string $name
 * @property float $value
 * @property string|null $params_json
 * @property string $service_id
 * @property string $user_id
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Favorite\Favorite whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Favorite\Favorite whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Favorite\Favorite whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Favorite\Favorite whereParamsJson($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Favorite\Favorite whereServiceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Favorite\Favorite whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Favorite\Favorite whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Favorite\Favorite whereValue($value)
 * @mixin \Eloquent
 * @property-read \App\Models\Service\Service $service
 * @property-read \App\Models\User\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Favorite\Favorite filterBy(\App\Services\Common\Filter\QueryFilter $queryFilter)
 */
class Favorite extends BaseModel
{
    use Filterable;
    use SoftDeletes;
    use UuidModel {
        UuidModel::boot as boot_uuid;
    }


    protected static function boot()
    {
        self::boot_uuid();
        static::addGlobalScope(new OwnUserIdScope);
    }

    protected $fillable = [
        'name', 
        'service_id', 
        'value',
        'amount',
        'params_json',
        'user_id'
    ];

    protected $casts = [
        'params_json' => 'array',
    ];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
