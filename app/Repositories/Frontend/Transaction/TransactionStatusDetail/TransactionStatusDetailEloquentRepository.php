<?php

namespace App\Repositories\Frontend\Transaction\TransactionStatusDetail;

use App\Repositories\Frontend\Transaction\TransactionStatusDetail\TransactionStatusDetailRepositoryContract;
use App\Models\Transaction\TransactionStatusDetail\TransactionStatusDetail;

class TransactionStatusDetailEloquentRepository implements TransactionStatusDetailRepositoryContract
{

    protected $transactionStatusDetail;

    public function __construct(TransactionStatusDetail $transactionStatusDetail)
    {
        $this->transactionStatusDetail = $transactionStatusDetail;
    }

    public function all($columns = ['*'])
    {
        return $this->transactionStatusDetail->get($columns);
    }



}