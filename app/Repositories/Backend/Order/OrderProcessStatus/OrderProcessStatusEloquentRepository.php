<?php
/**
 * Created by PhpStorm.
 * User: Ladmin
 * Date: 23.01.2020
 * Time: 16:35
 */

namespace App\Repositories\Backend\Order\OrderProcessStatus;


use App\Models\Order\OrderProcessStatus\OrderProcessStatus;
use App\Repositories\Backend\Order\OrderStatus\OrderStatusRepositoryContract;

class OrderProcessStatusEloquentRepository implements OrderProcessStatusRepositoryContract
{
    /**
     * @var OrderProcessStatus
     */
    private $orderProcessStatus;

    /**
     * OrderProcessStatusEloquentRepository constructor.
     * @param OrderProcessStatus $orderProcessStatus
     */
    public function __construct(OrderProcessStatus $orderProcessStatus)
    {
        $this->orderProcessStatus = $orderProcessStatus;
    }

    public function findById($id)
    {
        return $this->orderProcessStatus->where('id', $id)->first();
    }

    public function all($columns = ['*'])
    {
        return $this->orderProcessStatus->orderBy('name')->get($columns);
    }

    public function listsAll()
    {
        return $this->orderProcessStatus->orderBy('name')->get()->pluck('name', 'id');
    }

    public function getByStatusIds($statuses,$columns = ['*']){
        $orderProcessStatus = $this->orderProcessStatus
            ->whereIn('id', $statuses)
            ->orderBy('created_at', 'desc')
            ->get($columns);
        return  $orderProcessStatus;
    }
}