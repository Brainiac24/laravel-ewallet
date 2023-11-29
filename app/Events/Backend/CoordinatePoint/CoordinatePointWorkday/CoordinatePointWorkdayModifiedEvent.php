<?php

namespace App\Events\Backend\CoordinatePoint\CoordinatePointWorkday;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class CoordinatePointWorkdayModifiedEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $entity;

    public function __construct($entity)
    {
        $this->entity = $entity;
    }
}
