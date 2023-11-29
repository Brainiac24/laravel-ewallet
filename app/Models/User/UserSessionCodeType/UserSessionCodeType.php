<?php

namespace App\models\user\UserSessionCodeType;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Model;

class UserSessionCodeType extends BaseModel
{
    //

    protected $table = 'user_session_code_types';

    protected $fillable = [
        'id',
        'code',
        'name',
        'is_active'
    ];
}
