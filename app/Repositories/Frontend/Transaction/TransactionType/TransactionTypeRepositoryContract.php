<?php

namespace App\Repositories\Frontend\Transaction\TransactionType;

interface TransactionTypeRepositoryContract
{
    public function all($columns = ['*']);
}