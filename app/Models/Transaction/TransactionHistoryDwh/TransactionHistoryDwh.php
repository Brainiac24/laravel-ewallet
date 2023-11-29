<?php
/**
 * Created by PhpStorm.
 * User: Nabijon
 * Date: 26.08.2021
 * Time: 15:37
 */

namespace App\Models\Transaction\TransactionHistoryDwh;


use App\Models\BaseModel;

class TransactionHistoryDwh extends BaseModel
{
    protected $table = 'transaction_histories_dwh';
    protected $guarded = [];
    public $timestamps = false;

    protected $casts = [
        'params_json' => 'array',
        'request' => 'array',
        'response' => 'array',
    ];

}