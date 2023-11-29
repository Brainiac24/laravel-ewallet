<?php

namespace App\Events\Backend\User\UserHistory;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class UserModifiedForSettingEvent
{
    use Dispatchable, SerializesModels;

    public $old;
    public $new;
    public $class;
    public $id;
    public $event_code;

    public function __construct($old, $new, $class, $id, $event_code)
    {
        $this->old = $old;
        $this->new = $new;
        $this->class = $class;
        $this->id = $id;
        $this->event_code = $event_code;
    }

}
