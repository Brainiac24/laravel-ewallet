<?php

namespace App\Repositories\Frontend\Transaction\TransactionStatusDetail;

interface TransactionStatusDetailRepositoryContract
{
    public function all($columns = ['*']);
}