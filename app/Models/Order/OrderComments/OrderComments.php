<?php

namespace App\Models\Order\OrderComments;

use App\Models\BaseModel;
use App\Models\Order\OrderTypes\OrderTypes;

class OrderComments extends BaseModel
{
    protected $table = 'order_comments';

    protected $fillable = [
        'id',
        'order_type_id',
        'name',
        'short_name',
        'is_active',
        'code',
    ];

    //scopes
    public function scopeIsActive($q)
    {
        return $q->where('is_active', 1);
    }

    public function order_type()
    {
        return $this->belongsTo(OrderTypes::class, 'order_type_id');
    }
}
