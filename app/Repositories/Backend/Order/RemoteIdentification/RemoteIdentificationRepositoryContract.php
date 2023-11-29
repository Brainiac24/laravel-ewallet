<?php

namespace App\Repositories\Backend\Order\RemoteIdentification;


interface RemoteIdentificationRepositoryContract
{
    public function paginate($data = [], $perPage = 30, $columns = ['*']);

    public function findById($id);

    public function findByIdToTake($id);
}