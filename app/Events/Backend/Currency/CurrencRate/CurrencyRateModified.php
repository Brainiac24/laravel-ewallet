<?php

namespace App\Events\Backend\Currency\CurrencRate;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class CurrencyRateModified
{
//    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $rate;

    /**
     * CurrencyRateModified constructor.
     * @param $rate
     */
    public function __construct($rate)
    {
        $this->rate = $rate;
    }


}