<?php

namespace App\Repositories\Backend\Country;

interface CountryRepositoryContract
{
    public function all($search);

    public function getById($id);

    public function findById($id);

    public function create(array $data);

    public function update(array $data, $id);

    public function destroy($id);

    public function paginate($perPage = 30);
}