<?php

namespace App\Repositories\Backend\ReportType;

interface ReportTypeRepositoryContract
{

    public function findById($id);

    public function findByCode($code);

    public function create(array $data);

    public function update(array $data, $id);

    public function paginate($perPage = 30);
}