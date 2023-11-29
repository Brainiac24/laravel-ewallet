<?php

namespace App\Models\Transaction\TransactionType;

use App\Models\BaseModel;


/**
 * App\Models\Transaction\TransactionType\TransactionType
 *
 * @property string $id
 * @property string $code
 * @property string $name
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction\TransactionType\TransactionType whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction\TransactionType\TransactionType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction\TransactionType\TransactionType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction\TransactionType\TransactionType whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction\TransactionType\TransactionType whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class TransactionType extends BaseModel
{

    protected $fillable = [
        'name',
        'code',
    ];

}
