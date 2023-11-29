<?php
/**
 * Created by PhpStorm.
 * User: Nabijon
 * Date: 24.08.2021
 * Time: 16:05
 */

namespace App\Models\User\UserHistoryDwh;


use App\Models\BaseModel;

class UserHistoryDwh extends BaseModel
{
    protected $guarded = [];

    protected $table = "user_histories_dwh";

    protected $casts = [
        'old_params_json' => 'array',
        'new_params_json' => 'array',
    ];
}