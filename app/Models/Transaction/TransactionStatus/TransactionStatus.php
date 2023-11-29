<?php

namespace App\Models\Transaction\TransactionStatus;

use App\Models\BaseModel;
use App\Models\Transaction\TransactionStatusGroup\TransactionStatusGroup;


/**
 * App\Models\Transaction\TransactionStatus\TransactionStatus
 *
 * @property string $id
 * @property string $code
 * @property string $name
 * @property string|null $color
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction\TransactionStatus\TransactionStatus whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction\TransactionStatus\TransactionStatus whereColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction\TransactionStatus\TransactionStatus whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction\TransactionStatus\TransactionStatus whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction\TransactionStatus\TransactionStatus whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction\TransactionStatus\TransactionStatus whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property string $transaction_status_group_id
 * @property-read \App\Models\Transaction\TransactionStatusGroup\TransactionStatusGroup $transaction_status_group
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction\TransactionStatus\TransactionStatus whereTransactionStatusGroupId($value)
 */
class TransactionStatus extends BaseModel
{   


    public $table = 'transaction_status';

    protected $fillable = [
        'name',
        'color',
        'code',
        'transaction_status_group_id',
    ];

    public function transaction_status_group()
    {
        return $this->belongsTo(TransactionStatusGroup::class)->withDefault();
    }


}
