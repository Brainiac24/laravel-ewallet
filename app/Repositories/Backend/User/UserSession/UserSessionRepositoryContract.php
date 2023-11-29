<?php
/**
 * Created by PhpStorm.
 * User: Ladmin
 * Date: 03.09.2019
 * Time: 10:57
 */

namespace App\Repositories\Backend\User\UserSession;


interface UserSessionRepositoryContract
{
    public function findByUserId($userId, $columns = ['*']);
}