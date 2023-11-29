<?php

namespace App\Listeners\Backend\User;

use App\Repositories\Backend\User\UserRepositoryContract;

class UserSuccessfullLogin
{

    protected $userRepository;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(UserRepositoryContract $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Handle the event.
     *
     * @param  object $event
     * @return void
     */
    public function handle($event)
    {
        $this->userRepository->lastLoginUpdate(\Auth::id());
    }
}
