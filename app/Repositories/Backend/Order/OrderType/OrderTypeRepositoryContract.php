<?php
/**
 * Created by PhpStorm.
 * User: Ladmin
 * Date: 20.08.2019
 * Time: 15:55
 */

namespace App\Repositories\Backend\Order\OrderType;


interface OrderTypeRepositoryContract
{
    public function getAll($search);

    public function findById($id);
}