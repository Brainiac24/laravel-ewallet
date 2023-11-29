<?php

namespace App\Events\Frontend\User;

use App\Services\Common\Helpers\Events;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UserLogoutEvent
{
    use Dispatchable, SerializesModels;

    public $entity;
    public $event_code = Events::USER_LOGOUT;

    /**
     * UserAuthenticated constructor.
     * @param $entity
     */
    public function __construct($entity)
    {
        $this->entity = $entity;
    }
}
