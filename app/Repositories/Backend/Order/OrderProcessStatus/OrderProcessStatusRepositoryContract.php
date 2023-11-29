<?php
/**
 * Created by PhpStorm.
 * User: Ladmin
 * Date: 23.01.2020
 * Time: 16:35
 */

namespace App\Repositories\Backend\Order\OrderProcessStatus;


interface OrderProcessStatusRepositoryContract
{
    public function findById($id);

    public function all($columns = ['*']);

    public function getByStatusIds($statuses,$columns = ['*']);
}