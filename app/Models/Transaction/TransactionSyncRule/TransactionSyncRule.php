<?php

namespace App\Models\Transaction\TransactionSyncRule;

use App\Models\BaseModel;

class TransactionSyncRule extends BaseModel
{
    protected $fillable = [
        'id',
        'from_gateway_id',
        'to_gateway_id',
        'is_active',
    ];
}
