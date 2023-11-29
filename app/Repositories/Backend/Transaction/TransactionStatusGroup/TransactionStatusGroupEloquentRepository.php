<?php
/**
 * Created by PhpStorm.
 * User: F_Kosimov
 * Date: 18.07.2018
 * Time: 15:10
 */

namespace App\Repositories\Backend\Transaction\TransactionStatusGroup;

use App\Models\Transaction\TransactionStatusGroup\TransactionStatusGroup;

class TransactionStatusGroupEloquentRepository implements TransactionStatusGroupRepositoryContract

{

    protected $transactionStatusGroup;

    public function __construct(TransactionStatusGroup $transactionStatusGroup)
    {
        $this->transactionStatusGroup = $transactionStatusGroup;
    }

    public function getForDataTable()
    {

    }

    public function all($columns = ['*'])
    {
        $transactionStatusGroups = $this->transactionStatusGroup->orderBy('created_at', 'desc')->get($columns);
        return $transactionStatusGroups;
    }

    public function paginate($perPage = 30, $columns = ['*'])
    {
    }

    public function listsAll()
    {
        return $this->transactionStatusGroup->get()->pluck('name', 'id');
    }
    public function create(array $data)
    {
        return $this->transactionStatusGroup->create($data);
    }

    public function findById($id, $columns = ['*'])
    {
        return $this->transactionStatusGroup->select($columns)->findOrFail($id);
    }

    public function update(array $data, $id)
    {
        $transactionStatusGroup = $this->transactionStatusGroup->findOrFail($id);
        $transactionStatusGroup->update($data);
    }

    public function lastLoginUpdate($id)
    {

    }

    public function destroy($id)
    {
        $this->transactionStatusGroup->findOrFail($id)->delete();
    }
}