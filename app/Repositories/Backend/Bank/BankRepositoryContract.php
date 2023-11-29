<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 19.06.2019
 * Time: 10:37
 */

namespace App\Repositories\Backend\Bank;


interface BankRepositoryContract
{
    public function all($search);

    public function getIdByName($name);

    public function getIdByCodeMap($codeMap);

    public function paginate($perPage = 30, $columns = ['*']);

    public function getById($id);

    public function update(array $data, $id);

    public function destroy($id);

    public function create(array $data);
}