<?php
/**
 * Created by PhpStorm.
 * User: Ladmin
 * Date: 02.09.2019
 * Time: 11:36
 */

namespace App\Repositories\Backend\User\UserSessionCode;


use App\Models\User\UserSessionCode\Filters\UserSessionCodeFilter;
use App\Models\User\UserSessionCode\UserSessionCode;

class UserSessionCodeEloquentRepository implements  UserSessionCodeRepositoryContract
{
    /**
     * @var UserSessionCode
     */
    private $userSessionCode;

    /**
     * UserSessionCodeEloquentRepository constructor.
     * @param UserSessionCode $userSessionCode
     */
    public function __construct(UserSessionCode $userSessionCode)
    {
        $this->userSessionCode = $userSessionCode;
    }

    public function paginate($data = [], $perPage = 30, $columns = ['*'])
    {
        return $this->userSessionCode
            ->select($columns)
            ->with('user','user_session_code_type','user_session_code_channel')
            ->filterBy(new UserSessionCodeFilter($data))
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);
    }

    public function findById($id)
    {
        return $this->userSessionCode
            ->with('user','user_session_code_type','user_session_code_channel')
            ->where('id', $id)->first();
    }
}