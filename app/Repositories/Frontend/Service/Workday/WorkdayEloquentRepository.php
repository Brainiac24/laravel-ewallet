<?php

namespace App\Repositories\Frontend\Service\Workday;

use App\Repositories\Frontend\Service\Workday\WorkdayRepositoryContract;
use App\Models\Service\Workday\Workday;

class WorkdayEloquentRepository implements WorkdayRepositoryContract
{

    protected $workday;

    public function __construct(Workday $workday)
    {
        $this->workday = $workday;
    }

    public function all($columns = ['*'])
    {
        return $this->workday->get($columns);
    }



}