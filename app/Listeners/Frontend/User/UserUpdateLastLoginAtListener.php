<?php

namespace App\Listeners\Frontend\User;

use App\Events\Frontend\User\UserRegisteredWithPinEvent;
use App\Repositories\Frontend\User\UserRepositoryContract;

class UserUpdateLastLoginAtListener
{

    protected $userRepository;

    /**
     * Create the event listener.
     *
     * @param $userRepository
     * @return void
     */
    public function __construct(UserRepositoryContract $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Handle the event.
     *
     * @param  UserRegisteredWithPinEvent $event
     * @return void
     */
    public function handle($event)
    {
        $this->userRepository->updateLastLoginAt(\Auth::user());
    }
}
