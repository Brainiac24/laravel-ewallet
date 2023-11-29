<?php

namespace App\Repositories\Frontend\Currency\CurrencyRate;

interface CurrencyRateRepositoryContract
{
    public function all($columns = ['*']);
    public function getRate($columns = ['*']);
    public function allExceptTjs($columns = ['*']);
}