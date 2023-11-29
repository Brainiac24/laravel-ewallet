<?php

namespace App\Repositories\Backend\Order\OrderAccountTypeItem;

use App\Repositories\Backend\Order\OrderAccountTypeItem\OrderAccountTypeItemRepositoryContract;
use App\Models\Order\OrderAccountTypeItem\OrderAccountTypeItem;

class OrderAccountTypeItemEloquentRepository implements OrderAccountTypeItemRepositoryContract
{

    protected $orderAccountTypeItem;

    public function __construct(OrderAccountTypeItem $orderAccountTypeItem)
    {
        $this->orderAccountTypeItem = $orderAccountTypeItem;
    }

    public function all($search)
    {
        return $this->orderAccountTypeItem->where('name', 'like', '%' . $search . '%')->orderBy('name')->get();
    }

    public function paginate($data = [], $perPage = 30, $columns = ['*'])
    {
        return $this->orderAccountTypeItem->select($columns)->orderBy('created_at', 'desc')->paginate($perPage);
    }

    public function getById($id)
    {
        return $this->orderAccountTypeItem->where('id', $id)->first();
    }

    public function update(array $data, $id)
    {
        $orderAccountTypeItem = $this->orderAccountTypeItem->findOrFail($id);
        $orderAccountTypeItem->setOldAttributes($orderAccountTypeItem->getAttributes());
        $orderAccountTypeItem->update($data);
        return $orderAccountTypeItem;
    }

    public function destroy($id)
    {
        $orderAccountTypeItem = $this->orderAccountTypeItem->findOrFail($id);
        $orderAccountTypeItem->is_active = 0;
        $orderAccountTypeItem->save();
        return $orderAccountTypeItem;
    }

    public function create(array $data)
    {
        return $this->orderAccountTypeItem->create($data);
    }
       
    public function listsAll()
    {
        return $this->orderAccountTypeItem->orderBy('created_at', 'desc')->get()->pluck('name', 'id');
    }

}