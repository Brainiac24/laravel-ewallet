<?php

namespace App\Models\Account\AccountStatus;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Model;

class AccountStatus extends BaseModel
{
    //

    protected $table = 'account_status';

    protected $fillable = [
        'id',
        'code',
        'code_map',
        'name',
        'is_active'
    ];
}
