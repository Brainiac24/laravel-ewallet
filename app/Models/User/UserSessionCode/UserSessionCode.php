<?php
/**
 * Created by PhpStorm.
 * User: Ladmin
 * Date: 02.09.2019
 * Time: 11:38
 */

namespace App\Models\User\UserSessionCode;


use App\Models\BaseModel;
use App\Models\User\User;
use App\Models\User\UserSessionCodeChannel\UserSessionCodeChannel;
use App\models\user\UserSessionCodeType\UserSessionCodeType;
use App\Services\Common\Filter\Filterable;


class UserSessionCode extends BaseModel
{
    use Filterable;

    protected $table = 'user_session_codes';

    protected $fillable = [
        'id',
        'value',
        'code',
        'unblock_at',
        'blocked_at',
        'code_sent_at',
        'code_sent_count',
        'retry_send_code_try_count',
        'failed_confirm_try_count',
        'failed_confirm_try_at',
        'user_session_code_type_id',
        'entity_type',
        'entity_id',
        'user_session_code_channel_id',
        'create_by_user_id',
    ];

    public function getSmsCodeAttribute()
    {
        $len = strlen($this->attributes['code']);
        if($len>=4)
            return "***".substr($this->attributes['code'], 3,$len-3);
        else
            return "***";
    }

    public function user()
    {
        return $this->belongsTo(User::class,'created_by_user_id');
    }

    public function user_session_code_channel()
    {
        return $this->belongsTo(UserSessionCodeChannel::class);
    }

    public function user_session_code_type()
    {
        return $this->belongsTo(UserSessionCodeType::class);
    }
}