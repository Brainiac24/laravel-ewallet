<?php

namespace App\Repositories\Backend\Order\OrderDepositType;

use App\Repositories\Backend\Order\OrderDepositType\OrderDepositTypeRepositoryContract;
use App\Models\Order\OrderDepositType\OrderDepositType;

class OrderDepositTypeEloquentRepository implements OrderDepositTypeRepositoryContract
{

    protected $orderDepositType;

    public function __construct(OrderDepositType $orderDepositType)
    {
        $this->orderDepositType = $orderDepositType;
    }

    public function all($search)
    {
        return $this->orderDepositType->where('name', 'like', '%' . $search . '%')->orderBy('name')->get();
    }

    public function paginate($data = [], $perPage = 30, $columns = ['*'])
    {
        return $this->orderDepositType->with('service')->select($columns)->orderBy('created_at', 'desc')->paginate($perPage);
    }

    public function getById($id)
    {
        return $this->orderDepositType->where('id', $id)->first();
    }

    public function update(array $data, $id)
    {
        $orderDepositType = $this->orderDepositType->findOrFail($id);
        $orderDepositType->setOldAttributes($orderDepositType->getAttributes());
        $data['contract_html'] = $this->strReplaceNewLine($data['contract_html']);
        $data['detail_params_html'] = $this->strReplaceNewLine($data['detail_params_html']);
        $orderDepositType->update($data);
        return $orderDepositType;
    }

    public function destroy($id)
    {
        $orderDepositType = $this->orderDepositType->findOrFail($id);
        $orderDepositType->is_active = 0;
        $orderDepositType->save();
        return $orderDepositType;
    }

    public function create(array $data)
    {
        $data['contract_html'] = $this->strReplaceNewLine($data['contract_html']);
        $data['detail_params_html'] = $this->strReplaceNewLine($data['detail_params_html']);
        return $this->orderDepositType->create($data);
    }

    public function iconListsAll()
    {
        return $this->orderDepositType->orderBy('icon', 'ASC')->distinct("icon")->get()->pluck('icon', 'icon');
    }

    public function getIconsByNameAndNotEqualId($name, $id)
    {
        return $this->orderDepositType->where(["icon" => $name])
            ->where('id', '<>', $id)
            ->get();
    }

    
    public function listsAll()
    {
        return $this->orderDepositType->orderBy('created_at', 'desc')->get()->pluck('name', 'id');
    }

    protected function strReplaceNewLine($str)
    {
        return str_replace("\r\n", '',$str);
    }

}