<?php

namespace App\Models\Cashback\BonusAccrual;

use App\Models\BaseModel;
use App\Models\Cashback\BonusAccrual\BonusAccrualStatus\BonusAccrualStatus;
use App\Models\Cashback\Cashback;
use App\Models\Order\Order;
use App\Models\Transaction\Transaction;
use App\Models\User\User;
use App\Services\Common\Filter\Filterable;

class BonusAccrual extends BaseModel
{
    use Filterable;

    protected $fillable = [
        'id',
        'cashback_id',
        'user_id',
        'transaction_id',
        'order_id',
        'bonus_accrual_status_id',
    ];

    public function cashback()
    {
        return $this->belongsTo(Cashback::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function bonus_accrual_status()
    {
        return $this->belongsTo(BonusAccrualStatus::class, 'bonus_accrual_status_id');
    }
}
