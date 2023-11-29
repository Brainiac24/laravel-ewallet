<?php

namespace App\Repositories\Frontend\Transaction\TransactionStatus;

use App\Repositories\Frontend\Transaction\TransactionStatus\TransactionStatusRepositoryContract;
use App\Models\Transaction\TransactionStatus\TransactionStatus;

class TransactionStatusEloquentRepository implements TransactionStatusRepositoryContract
{

    protected $transactionStatus;

    public function __construct(TransactionStatus $transactionStatus)
    {
        $this->transactionStatus = $transactionStatus;
    }

    public function all($columns = ['*'])
    {
        return $this->transactionStatus->get($columns);
    }



}