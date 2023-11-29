<?php

namespace App\Repositories\Frontend\Transaction\TransactionStatus;

interface TransactionStatusRepositoryContract
{
    public function all($columns = ['*']);
}