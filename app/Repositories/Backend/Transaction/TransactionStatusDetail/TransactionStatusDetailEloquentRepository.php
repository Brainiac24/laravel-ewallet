<?php
/**
 * Created by PhpStorm.
 * User: F_Kosimov
 * Date: 18.07.2018
 * Time: 15:10
 */

namespace App\Repositories\Backend\Transaction\TransactionStatusDetail;

use App\Models\Transaction\TransactionStatusDetail\TransactionStatusDetail;

class TransactionStatusDetailEloquentRepository implements TransactionStatusDetailRepositoryContract

{

    protected $transactionStatusDetail;

    public function __construct(TransactionStatusDetail $transactionStatusDetail)
    {
        $this->transactionStatusDetail = $transactionStatusDetail;
    }

    public function getForDataTable()
    {

    }

    public function all($columns = ['*'])
    {
        $transactionStatusDetail = $this->transactionStatusDetail->orderBy('created_at', 'desc')->get($columns);
        return $transactionStatusDetail;
    }

    public function paginate($perPage = 30, $columns = ['*'])
    {
    }

    public function listsAll()
    {
        return $this->transactionStatusDetail->get()->pluck('name', 'id');
    }
    public function create(array $data)
    {
        return $this->transactionStatusDetail->create($data);
    }

    public function findById($id, $columns = ['*'])
    {
        return $this->transactionStatusDetail->select($columns)->findOrFail($id);
    }

    public function update(array $data, $id)
    {
        $transactionStatusDetail = $this->transactionStatusDetail->findOrFail($id);
        $transactionStatusDetail->setOldAttributes($transactionStatusDetail->getAttributes());
        $transactionStatusDetail->update($data);
        return $transactionStatusDetail;
    }

    public function lastLoginUpdate($id)
    {

    }

    public function destroy($id)
    {
        $transactionStatusDetail = $this->transactionStatusDetail->findOrFail($id);
        $transactionStatusDetail->setOldAttributes($transactionStatusDetail->getAttributes());
        $transactionStatusDetail->delete();
        return $transactionStatusDetail;
    }
}