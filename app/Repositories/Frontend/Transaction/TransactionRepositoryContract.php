<?php

namespace App\Repositories\Frontend\Transaction;

interface TransactionRepositoryContract
{
    public function all($columns = ['*']);

    public function create(array $data);

    public function getById($id, $columns = ['*']);

    public function allNotVerified($data = [], $columns = ['*']);

    public function findBySessionInWithoutGlobalScopes($session_in, $columns = ['*']);

}