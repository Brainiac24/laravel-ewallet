<?php

namespace App\Models\Transaction\TransactionStatusDetail;

use App\Models\BaseModel;


/**
 * App\Models\Transaction\TransactionStatusDetail\TransactionStatusDetail
 *
 * @property string $id
 * @property string $code
 * @property string $name
 * @property string|null $color
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction\TransactionStatusDetail\TransactionStatusDetail whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction\TransactionStatusDetail\TransactionStatusDetail whereColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction\TransactionStatusDetail\TransactionStatusDetail whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction\TransactionStatusDetail\TransactionStatusDetail whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction\TransactionStatusDetail\TransactionStatusDetail whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction\TransactionStatusDetail\TransactionStatusDetail whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class TransactionStatusDetail extends BaseModel
{   


    protected $fillable = [
        'name',
        'color',
        'code',
    ];
}
