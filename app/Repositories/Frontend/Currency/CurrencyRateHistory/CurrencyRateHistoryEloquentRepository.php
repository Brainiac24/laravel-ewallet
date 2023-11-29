<?php

namespace App\Repositories\Frontend\Currency\CurrencyRateHistory;

use App\Repositories\Frontend\Currency\CurrencyRateHistory\CurrencyRateHistoryRepositoryContract;
use App\Models\Currency\CurrencyRateHistory\CurrencyRateHistory;

class CurrencyRateHistoryEloquentRepository implements CurrencyRateHistoryRepositoryContract
{

    protected $currencyRateHistory;

    public function __construct(CurrencyRateHistory $currencyRateHistory)
    {
        $this->currencyRateHistory = $currencyRateHistory;
    }

    public function all($columns = ['*'])
    {
        return $this->currencyRateHistory->get($columns);
    }



}