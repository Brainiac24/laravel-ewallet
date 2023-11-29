<?php


namespace App\Repositories\Backend\Cashback\BonusAccrual\BonusAccrualStatus;


interface BonusAccrualStatusRepositoryContract
{
    public function getAll($search);

    public function findById($id);

    public function paginate($perPage = 30, $columns = ['*']);

    public function update(array $data, $id);

    public function create(array $data);

    public function destroy($id);
}