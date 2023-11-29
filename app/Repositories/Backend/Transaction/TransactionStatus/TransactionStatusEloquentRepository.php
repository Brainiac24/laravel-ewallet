<?php
/**
 * Created by PhpStorm.
 * User: F_Kosimov
 * Date: 18.07.2018
 * Time: 15:10
 */

namespace App\Repositories\Backend\Transaction\TransactionStatus;

use App\Models\Transaction\TransactionStatus\TransactionStatus;
use App\Services\Common\Helpers\TransactionStatus as TransactionStatusHelper;

class TransactionStatusEloquentRepository implements TransactionStatusRepositoryContract
{

    protected $transactionStatus;

    public function __construct(TransactionStatus $transactionStatus)
    {
        $this->transactionStatus = $transactionStatus;
    }

    public function getForDataTable()
    {

    }

    public function all($columns = ['*'])
    {
        $transactionStatus = $this->transactionStatus->orderBy('created_at', 'desc')->get($columns);
        return $transactionStatus;
    }

    public function allNotStatus($columns = ['*'])
    {
        $transactionStatus = $this->transactionStatus
            ->where('id','=', TransactionStatusHelper::new)
            ->orWhere('id', '=',TransactionStatusHelper::BLOCKED)
            ->orWhere('id', '=',TransactionStatusHelper::BLOCK_REJECTED)
            ->orWhere('id', '=',TransactionStatusHelper::PAY_COMPLETED)
            ->orWhere('id', '=',TransactionStatusHelper::PAY_REJECTED)
            ->orderBy('created_at', 'desc')
            ->get($columns);
        return $transactionStatus;
    }

    public function getByStatusIds($statuses,$columns = ['*']){
        $transactionStatus = $this->transactionStatus
            ->whereIn('id', $statuses)
            ->orderBy('created_at', 'desc')
            ->get($columns);
        return $transactionStatus;
    }



    public function paginate($perPage = 30, $columns = ['*'])
    {
    }

    public function listsAll()
    {
        return $this->transactionStatus->get()->pluck('name', 'id');
    }
    public function create(array $data)
    {
        return $this->transactionStatus->create($data);
    }

    public function findById($id, $columns = ['*'])
    {
        return $this->transactionStatus->select($columns)->findOrFail($id);
    }

    public function update(array $data, $id)
    {
        $transactionStatus = $this->transactionStatus->findOrFail($id);
        $transactionStatus->setOldAttributes($transactionStatus->getAttributes());
        $transactionStatus->update($data);
        return $transactionStatus;
    }

    public function lastLoginUpdate($id)
    {

    }

    public function destroy($id)
    {
        $transactionStatus = $this->transactionStatus->findOrFail($id);
        $transactionStatus->delete();
        return $transactionStatus;
    }

    public function getTransactionStatusesRule()
    {
        return $this->transactionStatus->whereIn('id', config('transactions.transaction_statuses'))->get();
    }
}