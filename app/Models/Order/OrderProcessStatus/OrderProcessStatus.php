<?php
/**
 * Created by PhpStorm.
 * User: F_Abdurashidov
 * Date: 14.12.2019
 * Time: 14:44
 */

namespace App\Models\Order\OrderProcessStatus;

use App\Models\BaseModel;

class OrderProcessStatus extends BaseModel
{
    protected $table = 'order_process_status';

    protected $fillable = [
        'id',
        'code',
        'name',
        'color',
        'is_active'
    ];
}