<?php
/**
 * Created by PhpStorm.
 * User: Ladmin
 * Date: 03.09.2019
 * Time: 17:54
 */

namespace App\Repositories\Backend\User\UserSessionCodeType;


use App\models\user\UserSessionCodeType\UserSessionCodeType;

class UserSessionCodeTypeEloquentRepository implements UserSessionCodeTypeRepositoryContract
{
    /**
     * @var UserSessionCodeType
     */
    private $userSessionCodeType;

    public function __construct(UserSessionCodeType $userSessionCodeType)
    {
        $this->userSessionCodeType = $userSessionCodeType;
    }

    public function getAll($search)
    {
        return $this->userSessionCodeType->where('name', 'like', '%' . $search . '%')->orderBy('name')->get();
    }
}