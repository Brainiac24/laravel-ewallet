<?php

namespace App\Events\Frontend\Transaction\TransactionHistory;


use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class TransactionModifiedEvent
{
    use Dispatchable, SerializesModels;

    public $entity;

    public function __construct($entity)
    {
        $this->entity = $entity;
    }


}
