<?php
/**
 * Created by PhpStorm.
 * User: Ladmin
 * Date: 03.02.2020
 * Time: 16:13
 */

namespace App\Models\Order\OrderHistory;


use App\Models\BaseModel;
use App\Models\Order\Order;
use App\Models\Order\OrderProcessStatus\OrderProcessStatus;
use App\Models\Order\OrderTypes\OrderTypes;
use App\Models\User\User;
use App\Models\Order\OrderStatus\OrderStatus;
use App\Services\Common\Filter\Filterable;
use Carbon\Carbon;

class OrderHistory extends BaseModel
{
    use Filterable;

    protected $fillable = [
        'order_id',
        'order_type_id',
        'number',
        'from_user_id',
        'to_user_id',
        'entity_type',
        'entity_id',
        'payload_params_json',
        'response',
        'order_status_id',
        'order_process_status_id',
        'is_queued'
    ];

    public $timestamps = false;

    protected $casts = [
        'payload_params_json' => 'array',
        'response' => 'array',
    ];

    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('d.m.Y H:i:s');
    }

    public function getUpdatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('d.m.Y H:i:s');
    }

    public function from_user()
    {
        return $this->belongsTo(User::class,'from_user_id');
    }

    public function to_user()
    {
        return $this->belongsTo(User::class,'to_user_id');
    }

    public function order()
    {
        return $this->belongsTo(Order::class,'order_id');
    }

    public function order_type()
    {
        return $this->belongsTo(OrderTypes::class,'order_type_id');
    }

    public function order_status()
    {
        return $this->belongsTo(OrderStatus::class,'order_status_id');
    }

    public function order_process_status()
    {
        return $this->belongsTo(OrderProcessStatus::class,'order_process_status_id');
    }

    public function updated_by_user()
    {
        return $this->belongsTo(User::class,'updated_by_user_id');
    }
}