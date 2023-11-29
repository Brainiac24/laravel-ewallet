<?php
/**
 * Created by PhpStorm.
 * User: Ladmin
 * Date: 29.08.2019
 * Time: 14:50
 */

namespace App\Repositories\Backend\Transaction\TransactionSyncStatus;


use App\Models\Transaction\TransactionSyncStatus\TransactionSyncStatus;

class TransactionSyncStatusEloquentRepository implements TransactionSyncStatusRepositoryContract
{
    /**
     * @var TransactionSyncStatus
     */
    private $transactionSyncStatus;

    public function __construct(TransactionSyncStatus $transactionSyncStatus)
    {
        $this->transactionSyncStatus = $transactionSyncStatus;
    }

    public function all($data=[],$columns = ['*'])
    {
        $transactionSyncStatus = $this->transactionSyncStatus->orderBy('created_at', 'desc')->get($columns);
        return $transactionSyncStatus;
    }

    public function findById($id, $columns = ['*'])
    {
        return $this->transactionSyncStatus->select($columns)->findOrFail($id);
    }
}