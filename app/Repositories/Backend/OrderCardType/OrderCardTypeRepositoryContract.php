<?php

namespace App\Repositories\Backend\OrderCardType;

interface OrderCardTypeRepositoryContract
{
    public function all($search);

    public function paginate($perPage = 30, $columns = ['*']);

    public function getById($id);

    public function update(array $data, $id);

    public function destroy($id);

    public function create(array $data);

    public function iconListsAll();

    public function getIconsByNameAndNotEqualId($name, $id);

    public function onOff($isActive, $cardTypeId);
}