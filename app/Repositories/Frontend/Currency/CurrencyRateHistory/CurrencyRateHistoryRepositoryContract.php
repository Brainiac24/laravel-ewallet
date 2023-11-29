<?php

namespace App\Repositories\Frontend\Currency\CurrencyRateHistory;

interface CurrencyRateHistoryRepositoryContract
{
    public function all($columns = ['*']);
}