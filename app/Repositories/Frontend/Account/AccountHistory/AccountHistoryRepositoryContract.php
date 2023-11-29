<?php

namespace App\Repositories\Frontend\Account\AccountHistory;

interface AccountHistoryRepositoryContract
{
    public function all($columns = ['*']);
}