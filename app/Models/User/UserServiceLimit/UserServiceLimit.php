<?php

namespace App\Models\User\UserServiceLimit;

use App\Models\BaseModel;
use App\Models\Service\Service;
use App\Models\Service\ServiceLimit\ServiceLimit;
use App\Models\User\User;
use App\Services\Common\Filter\Filterable;


/**
 * App\Models\User\UserServiceLimit\UserServiceLimit
 *
 * @property string $id
 * @property string $service_id
 * @property string $user_id
 * @property array $params_json
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Service\Service $service
 * @property-read \App\Models\User\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User\UserServiceLimit\UserServiceLimit filterBy(\App\Services\Common\Filter\QueryFilter $queryFilter)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User\UserServiceLimit\UserServiceLimit whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User\UserServiceLimit\UserServiceLimit whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User\UserServiceLimit\UserServiceLimit whereParamsJson($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User\UserServiceLimit\UserServiceLimit whereServiceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User\UserServiceLimit\UserServiceLimit whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User\UserServiceLimit\UserServiceLimit whereUserId($value)
 * @mixin \Eloquent
 */
class UserServiceLimit extends BaseModel
{
    use Filterable;

    protected $casts = [
        'params_json' => 'array',
        'extend_params_json' => 'array',
    ];

    protected $fillable = [
        'service_id',
        'user_id',
        'params_json',
        'extend_params_json',
    ];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

//    public function serviceLimit()
//    {
//        return $this->belongsTo(ServiceLimit::class);
//    }
}
