<?php

namespace App\Models\User\UserSessionCodeChannel;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Model;

class UserSessionCodeChannel extends BaseModel
{
    //

    protected $table = 'user_session_code_channels';

    protected $fillable = [
        'id',
        'code',
        'name',
        'is_active'
    ];
}
