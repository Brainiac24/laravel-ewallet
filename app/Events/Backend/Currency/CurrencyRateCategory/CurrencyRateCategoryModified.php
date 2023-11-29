<?php

namespace App\Events\Backend\Currency\CurrencRateCategory;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class CurrencyRateCategoryModified
{
//    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $rate;

    /**
     * CurrencyRateCategoryModified constructor.
     * @param $rate
     */
    public function __construct($rate)
    {
        $this->rate = $rate;
    }


}