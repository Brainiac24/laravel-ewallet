<?php
/**
 * Created by PhpStorm.
 * User: K_Hakimboev
 * Date: 25.07.2017
 * Time: 16:59
 */

namespace App\Repositories\Backend\User\UserHistory;

interface UserHistoryRepositoryContract
{
    public function getForDataTable();

    public function all($columns = ['*']);

    public function paginate($perPage = 30, $columns = ['*']);

    public function listsAll();

    public function create(array $data);

    public function findById($id, $columns = ['*']);

    public function findByMSISDN($msisdn, $columns = ['*']);

    public function update(array $data, $id);

    public function lastLoginUpdate($id);

    public function destroy($id);

    public function findByUserId($id);

    public function recordsBeforeDate($date);
}