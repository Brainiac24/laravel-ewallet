<?php

namespace App\Events\Frontend\Account\AccountHistory;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class AccountModifiedEvent
{
    use Dispatchable, SerializesModels;

    public $account;
    public $transaction;

    public function __construct($account, $transaction=null)
    {
        $this->account = $account;
        $this->transaction = $transaction;
    }
}
