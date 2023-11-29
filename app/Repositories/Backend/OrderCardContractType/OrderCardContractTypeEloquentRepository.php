<?php

namespace App\Repositories\Backend\OrderCardContractType;

use App\Repositories\Backend\OrderCardContractType\OrderCardContractTypeRepositoryContract;
use App\Models\OrderCardContractType\OrderCardContractType;

class OrderCardContractTypeEloquentRepository implements OrderCardContractTypeRepositoryContract
{

    protected $orderCardContractType;

    public function __construct(OrderCardContractType $orderCardContractType)
    {
        $this->orderCardContractType = $orderCardContractType;
    }

    public function all($columns = ['*'])
    {
        return $this->orderCardContractType->get($columns);
    }

    public function findById($id)
    {
        return $this->orderCardContractType::findOrFail($id);
    }

    public function listsAll()
    {
        return $this->orderCardContractType->orderBy('name', 'ASC')->get()->pluck('name', 'id');
    }

    public function listsAllActive()
    {
        return $this->orderCardContractType::where('is_active', 1)->orderBy('name', 'ASC')->get()->pluck('name', 'id');
    }

    public function create(array $cardContractType)
    {
        return $this->orderCardContractType::create($cardContractType);
    }

    public function update(array $fields, $id)
    {
        $cardContractType = $this->orderCardContractType::findOrFail($id);
        $cardContractType->fill($fields)->save();

        return $cardContractType;
    }

    public function disable($id)
    {
        $cardContractType = $this->orderCardContractType::findOrFail($id);
        $cardContractType->is_active = 0;
        $cardContractType->save();

        return true;
    }

}