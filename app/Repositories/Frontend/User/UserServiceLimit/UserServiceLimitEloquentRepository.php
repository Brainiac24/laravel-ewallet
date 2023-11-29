<?php

namespace App\Repositories\Frontend\User\UserServiceLimit;

use App\Repositories\Frontend\User\UserServiceLimit\UserServiceLimitRepositoryContract;
use App\Models\User\UserServiceLimit\UserServiceLimit;

class UserServiceLimitEloquentRepository implements UserServiceLimitRepositoryContract
{

    protected $userServiceLimit;

    public function __construct(UserServiceLimit $userServiceLimit)
    {
        $this->userServiceLimit = $userServiceLimit;
    }

    public function all($columns = ['*'])
    {
        return $this->userServiceLimit->get($columns);
    }

    public function findByServiceId($serviceId)
    {
        return $this->userServiceLimit->where('service_id', $serviceId)->first();
    }



}