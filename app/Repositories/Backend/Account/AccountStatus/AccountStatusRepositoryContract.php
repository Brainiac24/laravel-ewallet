<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 05.04.2019
 * Time: 13:43
 */

namespace App\Repositories\Backend\Account\AccountStatus;


interface AccountStatusRepositoryContract
{
    public function all();

    public function findById($id);

    public function update(array $data, $id);

    public function create(array $data);

    public function destroy($id);

    public function getIdByName($name);

    public function getIdByCodeMap($codeMap);
}