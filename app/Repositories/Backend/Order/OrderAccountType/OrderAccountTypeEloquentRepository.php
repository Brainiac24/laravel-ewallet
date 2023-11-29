<?php

namespace App\Repositories\Backend\Order\OrderAccountType;

use App\Repositories\Backend\Order\OrderAccountType\OrderAccountTypeRepositoryContract;
use App\Models\Order\OrderAccountType\OrderAccountType;

class OrderAccountTypeEloquentRepository implements OrderAccountTypeRepositoryContract
{

    protected $orderAccountType;

    public function __construct(OrderAccountType $orderAccountType)
    {
        $this->orderAccountType = $orderAccountType;
    }

    public function all($search)
    {
        return $this->orderAccountType->where('name', 'like', '%' . $search . '%')->orderBy('name')->get();
    }

    public function paginate($data = [], $perPage = 30, $columns = ['*'])
    {
        return $this->orderAccountType->select($columns)->orderBy('created_at', 'desc')->paginate($perPage);
    }

    public function getById($id)
    {
        return $this->orderAccountType->where('id', $id)->first();
    }

    public function update(array $data, $id)
    {
        $data['contract_html'] = $this->strReplaceNewLine($data['contract_html']);
        $orderAccountType = $this->orderAccountType->findOrFail($id);
        $orderAccountType->setOldAttributes($orderAccountType->getAttributes());
        $orderAccountType->update($data);
        return $orderAccountType;
    }

    public function destroy($id)
    {
        $orderAccountType = $this->orderAccountType->findOrFail($id);
        $orderAccountType->is_active = 0;
        $orderAccountType->save();
        return $orderAccountType;
    }

    public function create(array $data)
    {
        $data['contract_html'] = $this->strReplaceNewLine($data['contract_html']);
        return $this->orderAccountType->create($data);
    }

    public function iconListsAll()
    {
        return $this->orderAccountType->orderBy('icon', 'ASC')->distinct("icon")->get()->pluck('icon', 'icon');
    }

    public function getIconsByNameAndNotEqualId($name, $id)
    {
        return $this->orderAccountType->where(["icon" => $name])
            ->where('id', '<>', $id)
            ->get();
    }

   
    public function listsAll()
    {
        return $this->orderAccountType->orderBy('created_at', 'desc')->get()->pluck('name', 'id');
    }

    protected function strReplaceNewLine($str)
    {
        return str_replace("\r\n", '',$str);
    }
}