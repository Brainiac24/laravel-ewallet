<?php
/**
 * Created by PhpStorm.
 * User: Ladmin
 * Date: 18.10.2019
 * Time: 14:05
 */

namespace App\Models\Notification;


use App\Models\BaseModel;
use App\Services\Common\Filter\Filterable;

class Notification extends BaseModel
{
    use Filterable;
    //
    protected $fillable = [
        'id',
        'type',
        'user_id',
        'title',
        'description',
        'icon',
        'sound',
        'click_action',
        'is_active',
        'read_at',
    ];
}