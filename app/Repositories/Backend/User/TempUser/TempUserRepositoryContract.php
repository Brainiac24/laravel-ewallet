<?php

namespace App\Repositories\Backend\User\TempUser;

interface TempUserRepositoryContract
{
    public function all($columns = ['*']);

    public function getIdByCodeMap($code);

    public function findByMSISDN($msisdn);

    public function paginate($data = [], $perPage = 30, $columns = ['*']);

    public function findById($id);
}