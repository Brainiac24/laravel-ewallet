<?php

namespace App\Repositories\Frontend\Account\AccountTypeDetail;

interface AccountTypeDetailRepositoryContract
{
    public function all($columns = ['*']);
}