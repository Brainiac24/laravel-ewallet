<?php
/**
 * Created by PhpStorm.
 * User: Ladmin
 * Date: 03.09.2019
 * Time: 17:53
 */

namespace App\Repositories\Backend\User\UserSessionCodeType;


interface UserSessionCodeTypeRepositoryContract
{
    public function getAll($search);
}