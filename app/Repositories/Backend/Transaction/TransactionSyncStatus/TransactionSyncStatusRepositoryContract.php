<?php
/**
 * Created by PhpStorm.
 * User: Ladmin
 * Date: 29.08.2019
 * Time: 14:50
 */

namespace App\Repositories\Backend\Transaction\TransactionSyncStatus;


interface TransactionSyncStatusRepositoryContract
{
    public function all($columns = ['*']);
    public function findById($id, $columns = ['*']);
}