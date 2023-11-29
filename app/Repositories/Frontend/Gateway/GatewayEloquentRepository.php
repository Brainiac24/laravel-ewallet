<?php

namespace App\Repositories\Frontend\Gateway;

use App\Repositories\Frontend\Gateway\GatewayRepositoryContract;
use App\Models\Gateway\Gateway;

class GatewayEloquentRepository implements GatewayRepositoryContract
{

    protected $gateway;

    public function __construct(Gateway $gateway)
    {
        $this->gateway = $gateway;
    }

    public function all($columns = ['*'])
    {
        return $this->gateway->get($columns);
    }



}