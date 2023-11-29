<?php

namespace App\Repositories\Frontend\Transaction\TransactionHistory;

use App\Repositories\Frontend\Transaction\TransactionHistory\TransactionHistoryRepositoryContract;
use App\Models\Transaction\TransactionHistory\TransactionHistory;

class TransactionHistoryEloquentRepository implements TransactionHistoryRepositoryContract
{

    protected $transactionHistory;

    public function __construct(TransactionHistory $transactionHistory)
    {
        $this->transactionHistory = $transactionHistory;
    }

    public function all($columns = ['*'])
    {
        return $this->transactionHistory->get($columns);
    }


    public function create(array $data)
    {
        return $this->transactionHistory->create($data);
    }


}