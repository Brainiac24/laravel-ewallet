<?php
/**
 * Created by PhpStorm.
 * User: F_Kosimov
 * Date: 18.07.2018
 * Time: 15:10
 */

namespace App\Repositories\Backend\Transaction\TransactionType;

use App\Models\Transaction\TransactionType\TransactionType;

class TransactionTypeEloquentRepository implements TransactionTypeRepositoryContract
{

    protected $transactionType;

    public function __construct(TransactionType $transactionType)
    {
        $this->transactionType = $transactionType;
    }

    public function getForDataTable()
    {

    }

    public function all($columns = ['*'])
    {
        $transactionType = $this->transactionType->orderBy('created_at', 'desc')->get($columns);
        return $transactionType;
    }

    public function paginate($perPage = 30, $columns = ['*'])
    {
    }

    public function listsAll()
    {
        return $this->transactionType->get()->pluck('name', 'id');
    }
    public function create(array $data)
    {
        return $this->transactionType->create($data);
    }

    public function findById($id, $columns = ['*'])
    {
        return $this->transactionType->select($columns)->findOrFail($id);
    }

    public function update(array $data, $id)
    {
        $transactionType = $this->transactionType->findOrFail($id);
        $transactionType->setOldAttributes($transactionType->getAttributes());
        $transactionType->update($data);
        return $transactionType;
    }

    public function lastLoginUpdate($id)
    {

    }

    public function destroy($id)
    {
        $transactionType = $this->transactionType->findOrFail($id);
        $transactionType->setOldAttributes($transactionType->getAttributes());
        $transactionType->delete();
        return $transactionType;
    }
}