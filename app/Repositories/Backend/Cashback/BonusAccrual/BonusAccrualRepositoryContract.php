<?php


namespace App\Repositories\Backend\Cashback\BonusAccrual;


interface BonusAccrualRepositoryContract
{
    public function paginate($data = [], $perPage = 30, $columns = ['*']);

    public function findById($id);
}