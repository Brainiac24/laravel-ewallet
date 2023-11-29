<?php
/**
 * Created by PhpStorm.
 * User: Ladmin
 * Date: 21.08.2019
 * Time: 10:40
 */

namespace App\Repositories\Backend\Order\OrderStatus;


interface OrderStatusRepositoryContract
{
    public function getAll($search);

    public function findById($id);
}