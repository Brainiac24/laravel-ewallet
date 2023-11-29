<?php

namespace App\Listeners\Frontend\User\UserSession;

use App\Events\Frontend\User\UserRegisteredWithPinEvent;

use App\Repositories\Frontend\User\UserSession\UserSessionRepositoryContract;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SaveTokenListener
{

    protected $userSessionRepository;

    /**
     * Create the event listener.
     *
     * @param $userSessionRepository
     * @return void
     */
    public function __construct(UserSessionRepositoryContract $userSessionRepository)
    {
        $this->userSessionRepository = $userSessionRepository;
    }

    /**
     * Handle the event.
     *
     * @param  UserRegisteredWithPinEvent $event
     * @return void
     */
    public function handle($event)
    {
        $this->userSessionRepository->createOrUpdateForAuth(
            $event->authEntity->getAccessToken(),
            $event->authEntity->getAccessTokenExpireIn(),
            $event->authEntity->getRefreshToken(),
            $event->authEntity->getRefreshTokenExpireIn()
        );
    }
}
