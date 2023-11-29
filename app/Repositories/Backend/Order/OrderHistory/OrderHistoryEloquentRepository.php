<?php
/**
 * Created by PhpStorm.
 * User: Ladmin
 * Date: 03.02.2020
 * Time: 16:30
 */

namespace App\Repositories\Backend\Order\OrderHistory;


use App\Models\Order\OrderHistory\OrderHistory;

class OrderHistoryEloquentRepository implements OrderHistoryRepositoryContract
{
    /**
     * @var OrderHistory
     */
    private $orderHistory;

    /**
     * OrderHistoryEloquentRepository constructor.
     * @param OrderHistory $orderHistory
     */
    public function __construct(OrderHistory $orderHistory)
    {

        $this->orderHistory = $orderHistory;
    }

    public function findByOrderIdWithPaginate($orderId, $perPage = 30, $columns = ['*'])
    {
        return $this->orderHistory
            ->select($columns)
            ->where('order_id', $orderId)
            ->with('from_user',
                'to_user',
                'updated_by_user',
                'order_type',
                'order_status',
                'order_process_status')
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);
    }
}