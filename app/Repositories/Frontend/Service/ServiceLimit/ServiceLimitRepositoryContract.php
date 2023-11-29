<?php

namespace App\Repositories\Frontend\Service\ServiceLimit;

interface ServiceLimitRepositoryContract
{
    public function all($columns = ['*']);
}