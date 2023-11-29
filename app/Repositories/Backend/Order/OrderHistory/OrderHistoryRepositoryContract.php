<?php
/**
 * Created by PhpStorm.
 * User: Ladmin
 * Date: 03.02.2020
 * Time: 16:31
 */

namespace App\Repositories\Backend\Order\OrderHistory;


interface OrderHistoryRepositoryContract
{
    public function findByOrderIdWithPaginate($orderId, $perPage = 30, $columns = ['*']);
}