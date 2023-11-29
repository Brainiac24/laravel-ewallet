<?php

namespace App\Models\Transaction\TransactionSyncStatus;

use App\Models\BaseModel;

class TransactionSyncStatus extends BaseModel
{
    protected $fillable = [
        'id',
        'name',
        'code',
        'is_active',
    ];
}
