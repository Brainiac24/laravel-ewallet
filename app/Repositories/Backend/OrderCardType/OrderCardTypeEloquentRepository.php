<?php

namespace App\Repositories\Backend\OrderCardType;

use App\Models\OrderCardType\OrderCardType;
use App\Models\OrderCardType\Filters\OrderCardTypeFilter;
use App\Repositories\Backend\OrderCardType\OrderCardTypeRepositoryContract;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class OrderCardTypeEloquentRepository implements OrderCardTypeRepositoryContract
{

    protected $orderCardType;

    public function __construct(OrderCardType $orderCardType)
    {
        $this->orderCardType = $orderCardType;
    }

    public function all($search = '')
    {
        $query = $this->orderCardType::query()->select('id',DB::raw("CONCAT(name, ' (',YEAR,'года)') AS name"),'code', 'code_map', 'price', 'year', 'price', 'icon', 'position', 'is_active' );

        if($search){
            $query->where('name', 'like', '%' . $search . '%');
        }

        return $query->orderBy('name')->get();
    }

    public function paginate($data = [], $perPage = 30, $columns = ['*'])
    {
        return $this->orderCardType->with("currency")->select($columns)->filterBy(new OrderCardTypeFilter($data))->orderBy('created_at', 'desc')->paginate($perPage);
    }

    public function getById($id)
    {
        return $this->orderCardType->where('id', $id)->first();
    }

    public function update(array $data, $id)
    {
        $orderCardType = $this->orderCardType->findOrFail($id);
        $orderCardType->setOldAttributes($orderCardType->getAttributes());
        $orderCardType->update($data);
        return $orderCardType;
    }

    public function destroy($id)
    {
        $orderCardType = $this->orderCardType->findOrFail($id);
        $orderCardType->is_active = 0;
        $orderCardType->save();
        return $orderCardType;
    }

    public function create(array $data)
    {
        return $this->orderCardType->create($data);
    }

    public function iconListsAll()
    {
        return $this->orderCardType->orderBy('icon', 'ASC')->distinct("icon")->get()->pluck('icon', 'icon');
    }

    public function getIconsByNameAndNotEqualId($name, $id)
    {
        return $this->orderCardType->where(["icon" => $name])
            ->where('id', '<>', $id)
            ->get();
    }

    public function onOff($isActive, $cardTypeId)
    {
        Log::info('changing status of card type to is_active='.$isActive);
        $cardType = $this->getById($cardTypeId);
        $cardType->is_active = $isActive;
        $cardType->save();
    }

}