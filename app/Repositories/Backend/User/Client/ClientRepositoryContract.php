<?php
/**
 * Created by PhpStorm.
 * User: K_Hakimboev
 * Date: 25.07.2017
 * Time: 16:59
 */

namespace App\Repositories\Backend\User\Client;

interface ClientRepositoryContract
{
    public function getForDataTable();

    public function all($data=[],$columns = ['*']);

    public function paginate($data = [], $perPage = 30, $columns = ['*']);

    public function listsAll();

    public function create(array $data);

    public function findById($id, $columns = ['*']);

    public function findByMSISDN($msisdn, $columns = ['*']);

    public function update(array $data, $id);

    public function lastLoginUpdate($id);

    public function destroy($id);

    public function unlock($id);

    public function block($id);

    public function addCodeMap($id, $code_map);

    public function deleteCodeMap($id);

    public function resetPassword($id);

    public function deleteEmail($id);

    public function identificate(array $data, $id);

    public function identificateEdit(array $data, $id);

    public function updateLite(array $data, $id);

    public function resetIdentification($id);

    public function deletePin($id);
}