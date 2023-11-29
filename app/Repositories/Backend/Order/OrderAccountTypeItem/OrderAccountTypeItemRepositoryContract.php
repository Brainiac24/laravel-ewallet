<?php

namespace App\Repositories\Backend\Order\OrderAccountTypeItem;

interface OrderAccountTypeItemRepositoryContract
{
    public function all($search);

    public function paginate($perPage = 30, $columns = ['*']);

    public function getById($id);

    public function update(array $data, $id);

    public function destroy($id);

    public function create(array $data);

    public function listsAll();
}