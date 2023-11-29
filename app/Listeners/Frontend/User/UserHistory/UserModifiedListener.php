<?php

namespace App\Listeners\Frontend\User\UserHistory;

use App\Exceptions\Frontend\Api\LogicException;
use App\Models\User\User;
use App\Models\User\UserHistory\UserHistory;
use App\Repositories\Backend\User\UserHistory\UserHistoryRepositoryContract;
use App\Repositories\Frontend\User\Event\EventRepositoryContract;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class UserModifiedListener
{

    protected $userHistoryRepository;
    protected $eventRepository;

    public function __construct(UserHistoryRepositoryContract $userHistoryRepository, EventRepositoryContract $eventRepository)
    {
        $this->userHistoryRepository = $userHistoryRepository;
        $this->eventRepository = $eventRepository;
    }

    /**
     * @param $event
     * @throws LogicException
     */
    public function handle($event)
    {
        $user_id = null;
        // Проверка и назначение системного пользователя для обращения процессинга к нашей системе при пополнении баланса

        if ($event->entity instanceof User) {
            $user = $event->entity;
            $user_id = $user->id;
        } else {
            if (Auth::check()) {
                $user = Auth::user();
                $user_id = $user->id;
            } else {
                $user_id = config('app_settings.system_user_id');
            }
        }

        //dd($user);
        $userHistory = new UserHistory();
        $userHistory->user_id = $user_id;
        $userHistory->ip = Request::ip();
        $userHistory->old_params_json = $event->entity->getOldAttributes();
        $userHistory->new_params_json = $event->entity->getChanges();
        //dd($event->entity->getChanges());
        $userHistory->entity_type = get_class($event->entity);
        $userHistory->entity_id = $event->entity->id;
        //dd($event->event_code);
        $eventCode = $this->eventRepository->getById($event->event_code);
        /*EXEPTION*/
        if ($eventCode == null)
            throw new LogicException(trans('event.errors.code_not_found'));
        $userHistory->event_id = $eventCode->id;
        $userHistory->save();
    }
}
