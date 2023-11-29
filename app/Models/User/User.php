<?php

namespace App\Models\User;

use App\Models\Account\Account;
use App\Models\Account\Scopes\OwnUserIdScope;
use App\Models\Area\Area;
use App\Models\BaseAuthenticatable;
use App\Models\Branch\Branch;
use App\Models\City\City;
use App\Models\Country\Country;
use App\Models\DocumentType\DocumentType;
use App\Models\Region\Region;
use App\Models\User\Attestation\Attestation;
use App\Models\User\UserHistory\UserHistory;
use App\Models\User\UserSession\UserSession;
use App\Notifications\FCMNotification;
use App\Services\Common\Filter\Filterable;
use App\Services\Common\Helpers\Service;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Laratrust\Traits\LaratrustUserTrait;

/**
 * App\Models\User\User
 *
 * @property string $id
 * @property string $username
 * @property string|null $email
 * @property string|null $photo
 * @property string|null $tmp_email
 * @property float $msisdn
 * @property string|null $password
 * @property string|null $first_name
 * @property string|null $last_name
 * @property string|null $middle_name
 * @property string $attestation_id
 * @property string|null $sms_code
 * @property \Illuminate\Support\Carbon|null $sms_code_sent_at
 * @property int $sms_code_sent_count
 * @property int $sms_confirm_try_count
 * @property string|null $sms_confirm_try_at
 * @property string|null $email_code
 * @property \Illuminate\Support\Carbon|null $email_code_sent_at
 * @property int $email_code_sent_count
 * @property int $email_confirm_try_count
 * @property string|null $email_confirm_try_at
 * @property \Illuminate\Support\Carbon|null $email_send_unblock_at
 * @property string|null $pin
 * @property int $pin_confirm_try_count
 * @property string|null $pin_confirm_try_at
 * @property int $pin_change_try_count
 * @property \Illuminate\Support\Carbon|null $pin_change_try_at
 * @property \Illuminate\Support\Carbon|null $pin_change_unblock_at
 * @property int $blocked_count
 * @property \Illuminate\Support\Carbon|null $blocked_at
 * @property \Illuminate\Support\Carbon|null $unblock_at
 * @property string|null $last_login_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property bool $is_auth
 * @property bool $is_admin
 * @property bool $is_active
 * @property array|null $limits_json
 * @property array|null $contacts_json
 * @property array|null $user_settings_json
 * @property array|null $devices_json
 * @property string|null $description
 * @property string|null $ip
 * @property string|null $remember_token
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Account\Account[] $accounts
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Account\Account[] $accountsWithoutGlobalScope
 * @property-read \App\Models\User\Attestation\Attestation $attestation
 * @property-read mixed $full_name
 * @property-read mixed $hidden_email
 * @property-read mixed $pin_confirm_try_count_left
 * @property-read mixed $push_token
 * @property-read mixed $qr
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User\Permission\Permission[] $permissions
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User\Role\Role[] $roles
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User\UserHistory\UserHistory[] $user_histories
 * @property-read \App\Models\User\UserSession\UserSession $user_session
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User\User filterBy(\App\Services\Common\Filter\QueryFilter $queryFilter)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User\User isClient()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User\User isUser()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User\User whereAttestationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User\User whereBlockedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User\User whereBlockedCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User\User whereContactsJson($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User\User whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User\User whereDevicesJson($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User\User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User\User whereEmailCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User\User whereEmailCodeSentAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User\User whereEmailCodeSentCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User\User whereEmailConfirmTryAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User\User whereEmailConfirmTryCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User\User whereEmailSendUnblockAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User\User whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User\User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User\User whereIp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User\User whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User\User whereIsAdmin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User\User whereIsAuth($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User\User whereLastLoginAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User\User whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User\User whereLimitsJson($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User\User whereMiddleName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User\User whereMsisdn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User\User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User\User wherePermissionIs($permission = '')
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User\User wherePhoto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User\User wherePin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User\User wherePinChangeTryAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User\User wherePinChangeTryCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User\User wherePinChangeUnblockAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User\User wherePinConfirmTryAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User\User wherePinConfirmTryCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User\User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User\User whereRoleIs($role = '')
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User\User whereSmsCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User\User whereSmsCodeSentAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User\User whereSmsCodeSentCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User\User whereSmsConfirmTryAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User\User whereSmsConfirmTryCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User\User whereTmpEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User\User whereUnblockAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User\User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User\User whereUserSettingsJson($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User\User whereUsername($value)
 * @mixin \Eloquent
 */
class User extends BaseAuthenticatable
{
    use LaratrustUserTrait;
    use Notifiable;
    use Filterable;

    protected $casts = [
        'devices_json' => 'array',
        'verification_params_json' => 'array',
        'limits_json' => 'array',
        'user_settings_json' => 'array',
        'contacts_json' => 'array',
        'sms_params_json' => 'array',
        'pin_params_json' => 'array',
        'password_params_json' => 'array',
        'email_params_json' => 'array',
        'is_admin' => 'bool',
        'is_auth' => 'bool',
        'is_active' => 'bool',
        'msisdn' => 'float',
    ];

    protected $fillable = [
        'first_name',
        'last_name',
        'middle_name',
        'country_id',
        'country_born_id',
        'region_id',
        'area_id',
        'city_id',
        'document_type_id',
        'code_map',
        'devices_json',
        'contacts_json',
        'user_settings_json',
        'photo',
        'password_params_json',
        'is_active'
    ];

    protected $guarded = [
        'msisdn',
        'username',
        'is_admin',
        'is_auth',
        'is_active',
        'sms_code',
        'email_code',
        'pin',
        'blocked_at',
        'unblock_at',
        'pin_change_unblock_at',
        'blocked_count',
        'last_ip',
        'user_agent',
        'pin_confirm_try_count',
        'sms_confirm_try_count',
        'email_confirm_try_count',
        'pin_change_try_count',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'sms_code', 'email_code',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'sms_code_sent_at',
        'email_code_sent_at',
        'email_send_unblock_at',
        'pin_change_try_at',
        'pin_change_unblock_at',
        'unblock_at',
        'blocked_at',
    ];

    /*
     * поля для отправки смс кода
     */
    public function routeNotificationForSmsTj()
    {
        return $this->msisdn;
    }

    /**
     * Route notifications for the mail channel.
     *
     * @return string
     */
    public function routeNotificationForMail()
    {
        return $this->email;
    }

    /**
     * Route notifications for the fcm channel.
     *
     * @return string
     */
    public function routeNotificationForFcm()
    {
        return $this->devices_json['push_token'];
    }

    //accessor and mutator
    public function setPinAttribute($pin)
    {
        $this->attributes['pin'] = \Crypt::encrypt($pin);
    }

    public function getAddressAttribute()
    {
        $address = '';
        if (isset($this->contacts_json['street']))
            $address = $this->contacts_json['street'];
        if (isset($this->contacts_json['house']))
            $address.= ' '.$this->contacts_json['house'];
        if (isset($this->contacts_json['flat']))
            $address.= ' '.$this->contacts_json['flat'];
        return $address;
    }

    public function getPinAttribute()
    {
        //dd($this->attributes['pin']);
        if ($this->attributes['pin'] != null) {
            return \Crypt::decrypt($this->attributes['pin']);
        }
        return $this->attributes['pin'];
    }

    public function getFullNameAttribute()
    {
        $first_name = "";
        $middle_name = "";
        empty($this->first_name) ?: $first_name = sprintf("%s.", mb_substr($this->first_name, 0, 1, 'UTF-8'));
        empty($this->middle_name) ?: $middle_name = sprintf("%s.", mb_substr($this->middle_name, 0, 1, 'UTF-8'));

        return sprintf("%s %s %s", $this->last_name, $first_name, $middle_name);
    }

    public function getFullNameExtendedFormatAttribute()
    {
        return sprintf("%s %s %s", $this->first_name, $this->middle_name, $this->last_name);
    }

    public function getFullNameLiteAttribute()
    {
        $last_name = "";
        $first_name = "";
        $middle_name = "";
        empty($this->last_name) ?: $last_name = sprintf("%s.", mb_substr($this->last_name, 0, 1, 'UTF-8'));
        empty($this->first_name) ?: $first_name = sprintf("%s.", mb_substr($this->first_name, 0, 1, 'UTF-8'));
        empty($this->middle_name) ?: $middle_name = sprintf("%s.", mb_substr($this->middle_name, 0, 1, 'UTF-8'));

        return sprintf("%s %s %s", $last_name, $first_name, $middle_name);
    }

    public function getPushTokenAttribute()
    {
        return md5(isset($this->devices_json['push_token']) ? $this->devices_json['push_token'] : null);
    }

    public function getHiddenEmailAttribute()
    {
        $email = $this->attributes['email'];
        $em = explode("@", $email);
        $name = implode(array_slice($em, 0, count($em) - 1), '@');
        $len = floor(strlen($name) / 2);

        return substr($name, 0, $len) . str_repeat('*', $len) . "@" . end($em);
    }

    public function getPinConfirmTryCountLeftAttribute()
    {
        return config('auth_api.pin.confirm_try_count') - $this->attributes['pin_confirm_try_count'];
    }

    public function getQrAttribute()
    {
        $phone = $this->attributes['msisdn'];

        if (Str::startsWith($this->attributes['msisdn'], '992')) {
            $phone = substr($this->attributes['msisdn'], 3, strlen($this->attributes['msisdn']) - 3);
        }

        $data = [
            'service_id' => Service::EWALLET_ESKHATA,
            'phone' => $phone,
        ];

        return base64_encode(json_encode($data, JSON_UNESCAPED_UNICODE));
    }

    //scopes
    public function scopeIsClient($q)
    {
        return $q->where('is_admin', 0);
    }

    public function scopeIsUser($q)
    {
        return $q->where('is_admin', 1);
    }

    // relations
    public function attestation()
    {
        return $this->belongsTo(Attestation::class);
    }

    // relations
    public function document_type()
    {
        return $this->belongsTo(DocumentType::class);
    }
    public function country()
    {
        return $this->belongsTo(Country::class);
    }
    public function country_born()
    {
        return $this->belongsTo(Country::class, 'country_born_id');
    }
    public function region()
    {
        return $this->belongsTo(Region::class);
    }
    public function area()
    {
        return $this->belongsTo(Area::class);
    }
    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function accounts()
    {
        return $this->hasMany(Account::class);
    }

    public function accountsWithoutGlobalScope()
    {
        return $this->hasMany(Account::class)->withoutGlobalScope(OwnUserIdScope::class);
    }

    public function user_session()
    {
        return $this->hasMany(UserSession::class);
    }

    public function user_histories()
    {
        return $this->hasMany(UserHistory::class);
    }

    public function branches()
    {
        return $this->belongsToMany(Branch::class, 'user_branch');
    }

    public static function SendPushNotification($messageToSend)
    {
        $user = self::where('id', $messageToSend['user_id'])->first();

        if (isset($user->devices_json['push_token']) && !empty($user->devices_json['push_token'])) {
            return $user->notify(new FCMNotification($messageToSend));
        }
    }
}
