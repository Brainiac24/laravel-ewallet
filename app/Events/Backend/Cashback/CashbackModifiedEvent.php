<?php

namespace App\Events\Backend\Cashback;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class CashbackModifiedEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $entity;

    public function __construct($entity)
    {
        $this->entity = $entity;
    }
}
