<?php
/**
 * Created by PhpStorm.
 * User: Ladmin
 * Date: 21.08.2019
 * Time: 10:41
 */

namespace App\Repositories\Backend\Order\OrderStatus;


use App\Models\Order\OrderStatus\OrderStatus;

class OrderStatusEloquentRepository implements OrderStatusRepositoryContract
{

    /**
     * @var OrderStatus
     */
    private $orderStatus;

    public function __construct(OrderStatus $orderStatus)
    {

        $this->orderStatus = $orderStatus;
    }

    public function getAll($search)
    {
        return $this->orderStatus->where('name', 'like', '%' . $search . '%')->orderBy('name')->get();
    }

    public function listsAll()
    {
        return $this->orderStatus->orderBy('name')->get()->pluck('name', 'id');
    }

    public function findById($id)
    {
        return $this->orderStatus->where('id', $id)->first();
    }
}