<?php

namespace App\Repositories\Frontend\Currency;

interface CurrencyRepositoryContract
{
    public function all($columns = ['*']);
    public function getById($id, $columns = ['*']);
}