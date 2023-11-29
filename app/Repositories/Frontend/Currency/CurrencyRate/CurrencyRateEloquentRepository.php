<?php

namespace App\Repositories\Frontend\Currency\CurrencyRate;

use App\Models\Currency\CurrencyRate\CurrencyRate;


class CurrencyRateEloquentRepository implements CurrencyRateRepositoryContract
{

    protected $currencyRate;

    public function __construct(CurrencyRate $currencyRate)
    {
        $this->currencyRate = $currencyRate;
    }

    public function all($columns = ['*'])
    {
        return $this->currencyRate->get($columns);
    }

    public function allExceptTjs($columns = ['*'])
    {
        return $this->currencyRate
            ->with('currency')
            ->whereHas('currency', function ($q) {
                $q->where('is_active', 1);
            })
            ->where('currency_id', '!=', config('app_settings.currency_id_tjs'))->get($columns);
    }

    public function getRate($columns = ['*'])
    {
        return $this->currencyRate->with('currency')->first($columns);
    }


}