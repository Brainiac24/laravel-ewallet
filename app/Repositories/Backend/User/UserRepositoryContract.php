<?php
/**
 * Created by PhpStorm.
 * User: K_Hakimboev
 * Date: 25.07.2017
 * Time: 16:59
 */

namespace App\Repositories\Backend\User;

interface UserRepositoryContract
{
    public function getForDataTable();

    public function all($columns = ['*']);

    public function getAllUserWhereNotNullUserSettingsJson();

    public function paginate($perPage = 30, $columns = ['*']);

    public function listsAll();

    public function listAllIsAdmin();

    public function listsAllIsActive();

    public function create(array $data);

    public function findById($id, $columns = ['*']);

    public function findByMSISDN($msisdn, $columns = ['*']);

    public function update(array $data, $id);

    public function lastLoginUpdate($id);

    public function destroy($id);
    public function unlock($id);
    public function block($id);
    public function deleteEmail($id);

    public function getUserByCodeMapAndMsisdn($code_map, $msisdn);

    public function allClients($columns = ['*']);

    public function getByIds($ids);
}