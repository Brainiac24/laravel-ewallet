<?php
/**
 * Created by PhpStorm.
 * User: Ladmin
 * Date: 03.09.2019
 * Time: 10:57
 */

namespace App\Repositories\Backend\User\UserSession;


use App\Models\User\UserSession\UserSession;

class UserSessionEloquentRepository implements UserSessionRepositoryContract
{

    /**
     * @var UserSession
     */
    private $userSession;

    public function __construct(UserSession $userSession)
    {
        $this->userSession = $userSession;
    }

    public function findByUserId($userId, $columns = ['*'])
    {
        return $this->userSession->select($columns)->with('user')->findOrFail($userId);
    }
}