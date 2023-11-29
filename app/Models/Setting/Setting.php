<?php
/**
 * Created by PhpStorm.
 * User: F_Kosimov
 * Date: 19.07.2018
 * Time: 13:34
 */

namespace App\Models\Setting;

use App\Models\BaseModel;

class Setting extends BaseModel
{
    public $timestamps = false;

    protected $fillable = [
        'value'
    ];

}