<?php

namespace App\Models\User\UnverifiedUser;

use App\Models\BaseModel;

use App\Services\Common\Filter\Filterable;
use Illuminate\Notifications\Notifiable;

/**
 * App\Models\User\UnverifiedUser\UnverifiedUser
 * 
 * <<<<<<< HEAD
 *
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * =======
 * @property string $id
 * @property int $msisdn
 * @property string|null $sms_code
 * @property \Carbon\Carbon|null $sms_code_sent_at
 * @property int $sms_code_sent_count
 * @property int $sms_confirm_try_count
 * @property string|null $sms_confirm_try_at
 * @property int $blocked_count
 * @property \Carbon\Carbon|null $blocked_at
 * @property \Carbon\Carbon|null $unblock_at
 * @property string|null $user_agent
 * @property string|null $ip
 * @property string|null $token
 * @property array $devices_json
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[]
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User\UnverifiedUser\UnverifiedUser whereBlockedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User\UnverifiedUser\UnverifiedUser whereBlockedCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User\UnverifiedUser\UnverifiedUser whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User\UnverifiedUser\UnverifiedUser whereDevicesJson($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User\UnverifiedUser\UnverifiedUser whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User\UnverifiedUser\UnverifiedUser whereIp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User\UnverifiedUser\UnverifiedUser whereMsisdn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User\UnverifiedUser\UnverifiedUser whereSmsCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User\UnverifiedUser\UnverifiedUser whereSmsCodeSentAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User\UnverifiedUser\UnverifiedUser whereSmsCodeSentCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User\UnverifiedUser\UnverifiedUser whereSmsConfirmTryAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User\UnverifiedUser\UnverifiedUser whereSmsConfirmTryCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User\UnverifiedUser\UnverifiedUser whereToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User\UnverifiedUser\UnverifiedUser whereUnblockAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User\UnverifiedUser\UnverifiedUser whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User\UnverifiedUser\UnverifiedUser whereUserAgent($value)
 * >>>>>>> f4a2de0965a5e856c97ff04379418fc713c8545a
 * @mixin \Eloquent
 */
class UnverifiedUser extends BaseModel
{
    use Notifiable;
    use Filterable;


    protected $fillable = [
        'msisdn'
    ];

    protected $hidden = [
        'token',
        'sms_code',
    ];

    protected $casts = [
        'devices_json' => 'array',
        'sms_params_json' => 'array'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'sms_code_sent_at',
        'unblock_at',
        'blocked_at'
    ];

    /*
     * поля для отправки смс кода
     */
    public function routeNotificationForSmsTj()
    {
        return $this->msisdn;
    }

}
