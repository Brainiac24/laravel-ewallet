<?php

namespace App\Models\Order\OrderStatus;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Model;

class OrderStatus extends BaseModel
{
    //
    protected $table = 'order_status';

    protected $fillable = [
        'id',
        'code',
        'name',
        'is_active'
    ];
}
