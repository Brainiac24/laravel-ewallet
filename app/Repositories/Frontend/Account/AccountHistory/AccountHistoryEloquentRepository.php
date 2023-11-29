<?php

namespace App\Repositories\Frontend\Account\AccountHistory;

use App\Repositories\Frontend\Account\AccountHistory\AccountHistoryRepositoryContract;
use App\Models\Account\AccountHistory\AccountHistory;

class AccountHistoryEloquentRepository implements AccountHistoryRepositoryContract
{

    protected $accountHistory;

    public function __construct(AccountHistory $accountHistory)
    {
        $this->accountHistory = $accountHistory;
    }

    public function all($columns = ['*'])
    {
        return $this->accountHistory->get($columns);
    }



}