<?php
/**
 * Created by PhpStorm.
 * User: Ladmin
 * Date: 20.08.2019
 * Time: 15:58
 */

namespace App\Repositories\Backend\Order\OrderType;


use App\Models\Order\OrderTypes\OrderTypes;

class OrderTypeEloquentRepository implements OrderTypeRepositoryContract
{
    /**
     * @var OrderTypes
     */
    private $orderTypes;

    /**
     * OrderTypeEloquentRepository constructor.
     * @param OrderTypes $orderTypes
     */
    public function __construct(OrderTypes $orderTypes)
    {
        $this->orderTypes = $orderTypes;
    }

    public function getAll($search)
    {
        return $this->orderTypes->where('name', 'like', '%' . $search . '%')->orderBy('name')->get();
    }

    public function findById($id)
    {
        return $this->orderTypes->where('id', $id)->first();
    }

    public function listAll()
    {
        return $this->orderTypes->orderBy('name')->get()->pluck('name', 'id');
    }
}