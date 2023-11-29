<?php

namespace App\Repositories\Frontend\Transaction\TransactionType;

use App\Repositories\Frontend\Transaction\TransactionType\TransactionTypeRepositoryContract;
use App\Models\Transaction\TransactionType\TransactionType;

class TransactionTypeEloquentRepository implements TransactionTypeRepositoryContract
{

    protected $transactionType;

    public function __construct(TransactionType $transactionType)
    {
        $this->transactionType = $transactionType;
    }

    public function all($columns = ['*'])
    {
        return $this->transactionType->get($columns);
    }



}