<?php

namespace App\Models\Order\OrderTypes;

use App\Models\BaseModel;

class OrderTypes extends BaseModel
{
    //
    protected $table = 'order_types';

    protected $fillable = [
        'id',
        'code',
        'name',
        'is_active'
    ];
}
