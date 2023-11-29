<?php

namespace App\Repositories\Frontend\Service;

use App\Repositories\Frontend\Service\ServiceRepositoryContract;
use App\Models\Service\Service;

class ServiceEloquentRepository implements ServiceRepositoryContract
{

    protected $service;

    public function __construct(Service $service)
    {
        $this->service = $service;
    }

    public function all($columns = ['*'])
    {
        return $this->service->with(['gateways', 'workday', 'commission', 'service_limits'])->get($columns);
    }

    public function allActive($columns = ['*'])
    {
        return $this->service->with(['gateways', 'workday', 'commission', 'service_limits'])->where('is_active', true)->get($columns);
    }

    public function getByCode($code, $columns = ['*'])
    {
        return $this->service->with(['gateway', 'workday', 'commission', 'service_limit'])->where('code', $code)->first($columns);
    }

    public function getIdByCode($code)
    {
        return $this->service->where('code', $code)->first(['id'])->id;
    }

    public function getById($id, $columns = ['*'])
    {
        return $this->service->find($id);
    }

    public function getByIdActive($id, $columns = ['*'])
    {
        return $this->service->where('is_active', true)->find($id);
    }

    public function findById($id, $columns = ['*'])
    {
        return $this->service->with(['gateway', 'workday', 'currency', 'commission', 'service_limit'])->where('is_active', true)->find($id);
    }


}