<?php

namespace App\Models\Transaction\TransactionStatusGroup;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Transaction\TransactionStatusGroup\TransactionStatusGroup
 *
 * @property string $id
 * @property string $code
 * @property string $name
 * @property string|null $color
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction\TransactionStatusGroup\TransactionStatusGroup whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction\TransactionStatusGroup\TransactionStatusGroup whereColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction\TransactionStatusGroup\TransactionStatusGroup whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction\TransactionStatusGroup\TransactionStatusGroup whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction\TransactionStatusGroup\TransactionStatusGroup whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction\TransactionStatusGroup\TransactionStatusGroup whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class TransactionStatusGroup extends BaseModel
{
    protected $fillable = [
        'name',
        'color',
        'code',
    ];
}
