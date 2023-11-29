<?php

namespace App\Repositories\Frontend\Service\Workday;

interface WorkdayRepositoryContract
{
    public function all($columns = ['*']);
}