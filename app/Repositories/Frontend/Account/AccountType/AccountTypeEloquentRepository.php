<?php

namespace App\Repositories\Frontend\Account\AccountType;

use App\Repositories\Frontend\Account\AccountType\AccountTypeRepositoryContract;
use App\Models\Account\AccountType\AccountType;

class AccountTypeEloquentRepository implements AccountTypeRepositoryContract
{

    protected $accountType;

    public function __construct(AccountType $accountType)
    {
        $this->accountType = $accountType;
    }

    public function all($columns = ['*'])
    {
        return $this->accountType->get($columns);
    }



}