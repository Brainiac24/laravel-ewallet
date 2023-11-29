<?php

namespace App\Repositories\Frontend\Service\Commission;

use App\Repositories\Frontend\Service\Commission\CommissionRepositoryContract;
use App\Models\Service\Commission\Commission;

class CommissionEloquentRepository implements CommissionRepositoryContract
{

    protected $commission;

    public function __construct(Commission $commission)
    {
        $this->commission = $commission;
    }

    public function all($columns = ['*'])
    {
        return $this->commission->get($columns);
    }

    public function getById($id, $columns = ['*'])
    {
        return $this->favorite->where('id', $id)->first();
    }



}