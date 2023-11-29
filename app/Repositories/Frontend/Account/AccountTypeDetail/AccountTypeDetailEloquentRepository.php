<?php

namespace App\Repositories\Frontend\Account\AccountTypeDetail;

use App\Repositories\Frontend\Account\AccountTypeDetail\AccountTypeDetailRepositoryContract;
use App\Models\Account\AccountTypeDetail\AccountTypeDetail;

class AccountTypeDetailEloquentRepository implements AccountTypeDetailRepositoryContract
{

    protected $accountTypeDetail;

    public function __construct(AccountTypeDetail $accountTypeDetail)
    {
        $this->accountTypeDetail = $accountTypeDetail;
    }

    public function all($columns = ['*'])
    {
        return $this->accountTypeDetail->get($columns);
    }



}