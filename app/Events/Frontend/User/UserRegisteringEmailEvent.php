<?php

namespace App\Events\Frontend\User;

use App\Models\User\User;
use App\Services\Common\Helpers\Events;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UserRegisteringEmailEvent
{
    use Dispatchable, SerializesModels;

    public $entity;
    public $event_code = Events::USER_REGISTERING_EMAIL;

    /**
     * UserAuthenticated constructor.
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->entity = $user;
    }
}
