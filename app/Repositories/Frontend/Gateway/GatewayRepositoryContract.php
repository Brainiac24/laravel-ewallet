<?php

namespace App\Repositories\Frontend\Gateway;

interface GatewayRepositoryContract
{
    public function all($columns = ['*']);
}