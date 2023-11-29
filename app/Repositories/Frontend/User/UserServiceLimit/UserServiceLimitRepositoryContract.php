<?php

namespace App\Repositories\Frontend\User\UserServiceLimit;

interface UserServiceLimitRepositoryContract
{
    public function all($columns = ['*']);

    public function findByServiceId($serviceId);
}