<?php

namespace App\Repositories\Frontend\Service\Commission;

interface CommissionRepositoryContract
{
    public function all($columns = ['*']);

    public function getById($id, $columns = ['*']);
}