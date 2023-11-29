<?php

namespace App\Listeners\Backend\Currency\CurrencyRateHistory;

use App\Events\Backend\Currency\CurrencRate\CurrencyRateModified;
use App\Models\Currency\CurrencyRate\CurrencyRate;
use App\Repositories\Backend\Currency\CurrencyRateHistory\CurrencyRateHistoryRepositoryContract;

class SaveCurrencyHistoryListener
{

    protected $currencyRateHistoryRepository;

    /**
     * Create the event listener.
     *
     * @param CurrencyRateHistoryRepositoryContract $currencyRateHistoryRepository
     * @return void
     */
    public function __construct(CurrencyRateHistoryRepositoryContract $currencyRateHistoryRepository)
    {
        $this->currencyRateHistoryRepository = $currencyRateHistoryRepository;
    }

    /**
     * Handle the event.
     *
     * @param  CurrencyRateModified $event
     * @return void
     */
    public function handle(CurrencyRateModified $event)
    {
        $this->currencyRateHistoryRepository->create($event->rate->getAttributes());
    }
}
