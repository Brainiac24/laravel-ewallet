<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 01.08.2019
 * Time: 15:20
 */

namespace App\Repositories\Backend\Order;


use App\Models\Order\Filters\OrderFilter;
use App\Models\Order\Order;
use App\Services\Common\Helpers\OrderProcessStatus;
use App\Services\Common\Helpers\OrderQueuedStatus;
use App\Services\Common\Helpers\OrderType;

class OrderEloquentRepository implements OrderRepositoryContract
{

    /**
     * @var Order
     */
    private $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function paginate($data = [], $perPage = 30, $columns = ['*'])
    {
        return $this->order->select($columns)
            ->with('from_user', 'to_user', 'order_type', 'order_status','order_process_status')
            ->filterBy(new OrderFilter($data))->orderBy('created_at', 'desc')
            ->paginate($perPage);
    }

    public function findById($id)
    {
        return $this->order->with('from_user', 'to_user', 'order_type', 'order_status')->where('id', $id)->first();
    }

    public function getAllByWillContinueProcess(){
        return $this->order
            ->where('is_queued', OrderQueuedStatus::MUST_CONTINUE)
            ->whereNotIn('order_process_status_id', [OrderProcessStatus::COMPLETED,OrderProcessStatus::REJECTED])
            ->get();
    }

    public function update(array $data, $id)
    {
        $order = $this->order->findOrFail($id);
        $order->setOldAttributes($order->getAttributes());
        $order->update($data);
        return $order;
    }

    /**
     * @param $data array
     */
    public function paginateForDepositOpeningTransaction($data,$perPage = 30)
    {
        return $this->order::with('from_user', 'to_user', 'order_type', 'order_status','order_process_status')
             ->where('order_type_id', OrderType::DEPOSIT_TYPE_ITEM_CREATE)
             ->filterBy(new OrderFilter($data))->orderBy('created_at', 'desc')->paginate($perPage);
    }
}