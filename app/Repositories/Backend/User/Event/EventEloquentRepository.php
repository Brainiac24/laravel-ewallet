<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 01.08.2019
 * Time: 11:04
 */

namespace App\Repositories\Backend\User\Event;


use App\Models\User\Event\Event;
use App\Models\User\Event\Filters\EventFilter;

class EventEloquentRepository implements EventRepositoryContract
{

    /**
     * @var Event
     */
    private $event;

    public function __construct(Event $event)
    {
        $this->event = $event;
    }

    public function paginate($data = [], $perPage = 30, $columns = ['*'])
    {
        return $this->event->select($columns)->filterBy(new EventFilter($data))->orderBy('created_at', 'desc')->paginate($perPage);
    }

    public function getById($id)
    {
        return $this->event->where('id', $id)->first();
    }
}