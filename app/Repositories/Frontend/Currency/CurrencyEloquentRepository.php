<?php

namespace App\Repositories\Frontend\Currency;

use App\Repositories\Frontend\Currency\CurrencyRepositoryContract;
use App\Models\Currency\Currency;

class CurrencyEloquentRepository implements CurrencyRepositoryContract
{

    protected $currency;

    public function __construct(Currency $currency)
    {
        $this->currency = $currency;
    }

    public function all($columns = ['*'])
    {
        return $this->currency->get($columns);
    }



    public function getById($id, $columns = ['*'])
    {
        return $this->currency->get($columns)->find($id);
    }




}