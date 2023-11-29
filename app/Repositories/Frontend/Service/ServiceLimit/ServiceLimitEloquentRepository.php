<?php

namespace App\Repositories\Frontend\Service\ServiceLimit;

use App\Repositories\Frontend\Service\ServiceLimit\ServiceLimitRepositoryContract;
use App\Models\Service\ServiceLimit\ServiceLimit;

class ServiceLimitEloquentRepository implements ServiceLimitRepositoryContract
{

    protected $serviceLimit;

    public function __construct(ServiceLimit $serviceLimit)
    {
        $this->serviceLimit = $serviceLimit;
    }

    public function all($columns = ['*'])
    {
        return $this->serviceLimit->get($columns);
    }



}