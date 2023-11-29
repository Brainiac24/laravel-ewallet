<?php

namespace App\Repositories\Backend\Job\JobHistory;


interface JobHistoryRepositoryContract
{
    public function all($data = [], $columns = ['*']);

    public function paginate($perPage = 30, $columns = ['*']);

    public function create(array $data);

    public function update(array $data, $id);

    public function findById($id);
}