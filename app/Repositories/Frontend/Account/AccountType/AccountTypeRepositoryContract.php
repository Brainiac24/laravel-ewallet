<?php

namespace App\Repositories\Frontend\Account\AccountType;

interface AccountTypeRepositoryContract
{
    public function all($columns = ['*']);
}