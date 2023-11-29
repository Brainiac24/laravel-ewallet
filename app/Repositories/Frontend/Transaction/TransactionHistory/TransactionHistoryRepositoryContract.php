<?php

namespace App\Repositories\Frontend\Transaction\TransactionHistory;

interface TransactionHistoryRepositoryContract
{
    public function all($columns = ['*']);

    public function create(array $data);
}