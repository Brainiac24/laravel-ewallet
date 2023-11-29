<?php


namespace App\Repositories\Backend\Transaction\TransactionContinueRule;


interface TransactionContinueRuleRepositoryContract
{
    public function all($search);

    public function findById($id);

    public function paginate($data=[], $perPage = 30, $columns = ['*']);

    public function update(array $data, $id);

    public function create(array $data);

    public function destroy($id);

    public function getFirst($data=[]);
}