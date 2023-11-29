<?php

namespace App\Events\Frontend\User\UserHistory;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class UserModifiedEvent
{
    use Dispatchable, SerializesModels;

    public $entity;
    public $event_code;

    public function __construct($entity, $event_code)
    {
        $this->entity = $entity;
        $this->event_code = $event_code;
    }

}
