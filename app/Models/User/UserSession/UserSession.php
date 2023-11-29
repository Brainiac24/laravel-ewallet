<?php

namespace App\Models\User\UserSession;

use App\Models\BaseModel;
use App\Models\User\User;


/**
 * App\Models\User\UserSession\UserSession
 *
 * @property string $id
 * @property string $user_id
 * @property string $access_token
 * @property string $access_token_expires_at
 * @property string $refresh_token
 * @property string|null $refresh_token_expires_at
 * @property string|null $revoked_at
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User\UserSession\UserSession whereAccessToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User\UserSession\UserSession whereAccessTokenExpiresAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User\UserSession\UserSession whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User\UserSession\UserSession whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User\UserSession\UserSession whereRefreshToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User\UserSession\UserSession whereRefreshTokenExpiresAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User\UserSession\UserSession whereRevokedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User\UserSession\UserSession whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User\UserSession\UserSession whereUserId($value)
 * @mixin \Eloquent
 */
class UserSession extends BaseModel
{


    protected $guarded = [
        'access_token',
        'refresh_token',
    ];

    protected $casts = [
        'device_params_json' => 'array'
    ];
    protected $dates = [
        'access_token_expires_at',
        'refresh_token_expires_at',
        'revoked_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
