<?php

namespace App\Repositories\Frontend\User\Event;

interface EventRepositoryContract
{
    public function all($columns = ['*']);
    public function getByCode($code, $columns = ['*']);
    public function getById($id, $columns = ['*']);
}