<?php

namespace App\Repositories\Backend\Order\OrderDepositTypeItem;

use App\Repositories\Backend\Order\OrderDepositTypeItem\OrderDepositTypeItemRepositoryContract;
use App\Models\Order\OrderDepositTypeItem\OrderDepositTypeItem;

class OrderDepositTypeItemEloquentRepository implements OrderDepositTypeItemRepositoryContract
{

    protected $orderDepositTypeItem;

    public function __construct(OrderDepositTypeItem $orderDepositTypeItem)
    {
        $this->orderDepositTypeItem = $orderDepositTypeItem;
    }

    public function all($search)
    {
        return $this->orderDepositTypeItem->where('name', 'like', '%' . $search . '%')->orderBy('name')->get();
    }

    public function paginate($data = [], $perPage = 30, $columns = ['*'])
    {
        return $this->orderDepositTypeItem->select($columns)->orderBy('created_at', 'desc')->paginate($perPage);
    }

    public function getById($id)
    {
        return $this->orderDepositTypeItem->where('id', $id)->first();
    }

    public function update(array $data, $id)
    {
        $orderDepositTypeItem = $this->orderDepositTypeItem->findOrFail($id);
        $orderDepositTypeItem->setOldAttributes($orderDepositTypeItem->getAttributes());
        $orderDepositTypeItem->update($data);
        return $orderDepositTypeItem;
    }

    public function destroy($id)
    {
        $orderDepositTypeItem = $this->orderDepositTypeItem->findOrFail($id);
        $orderDepositTypeItem->is_active = 0;
        $orderDepositTypeItem->save();
        return $orderDepositTypeItem;
    }

    public function create(array $data)
    {
        return $this->orderDepositTypeItem->create($data);
    }



}