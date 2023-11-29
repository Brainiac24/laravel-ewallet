<?php

namespace App\Repositories\Frontend\User\Event;

use App\Repositories\Frontend\User\Event\EventRepositoryContract;
use App\Models\User\Event\Event;

class EventEloquentRepository implements EventRepositoryContract
{

    protected $event;

    public function __construct(Event $event)
    {
        $this->event = $event;
    }

    public function all($columns = ['*'])
    {
        return $this->event->get($columns);
    }

    public function getByCode($code, $columns = ['*'])
    {
        return $this->event->where('code', $code)->first($columns);
    }

    public function getById($id, $columns = ['*'])
    {
        return $this->event->find($id);
    }


}