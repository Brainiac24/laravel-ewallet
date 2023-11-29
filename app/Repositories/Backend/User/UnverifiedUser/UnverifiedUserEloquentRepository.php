<?php
/**
 * Created by PhpStorm.
 * User: Ladmin
 * Date: 30.08.2019
 * Time: 11:05
 */

namespace App\Repositories\Backend\User\UnverifiedUser;


use App\Models\User\UnverifiedUser\Filters\UnverifiedUserFilter;
use App\Models\User\UnverifiedUser\UnverifiedUser;

class UnverifiedUserEloquentRepository implements UnverifiedUserRepositoryContract
{
    /**
     * @var UnverifiedUser
     */
    private $unverifiedUser;

    public function __construct(UnverifiedUser $unverifiedUser)
    {
        $this->unverifiedUser = $unverifiedUser;
    }

    public function paginate($data = [], $perPage = 30, $columns = ['*'])
    {
        return $this->unverifiedUser->select($columns)->filterBy(new UnverifiedUserFilter($data))->orderBy('created_at', 'desc')->paginate($perPage);
    }

    public function findById($id)
    {
        return $this->unverifiedUser->where('id', $id)->first();
    }
}