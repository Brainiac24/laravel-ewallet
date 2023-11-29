<?php

namespace App\Events\Frontend\User;

use App\Models\User\User;
use App\Services\Common\Auth\AuthEntity;
use App\Services\Common\Helpers\Events;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UserRegisteredWithPinEvent
{
    //use Dispatchable, InteractsWithSockets, SerializesModels;
    use Dispatchable, SerializesModels;

    public $entity;
    public $authEntity;
    public $event_code = Events::USER_REGISTERED_WITH_PIN;

    /**
     * UserRegistered constructor.
     * @param User $user
     * @param AuthEntity $authEntity
     */
    public function __construct(User $user, AuthEntity $authEntity)
    {
        $this->entity = $user;
        $this->authEntity = $authEntity;
    }
}
