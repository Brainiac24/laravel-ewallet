<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 01.08.2019
 * Time: 11:03
 */

namespace App\Repositories\Backend\User\Event;


interface EventRepositoryContract
{
    public function paginate($data = [], $perPage = 30, $columns = ['*']);

    public function getById($id);
}