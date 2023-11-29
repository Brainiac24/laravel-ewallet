<?php
/**
 * Created by PhpStorm.
 * User: F_Kosimov
 * Date: 18.07.2018
 * Time: 15:10
 */

namespace App\Repositories\Backend\Account\AccountType;


interface AccountTypeRepositoryContract
{
    public function getForDataTable();

    public function getAll($search);

    /**
     * @param array $columns
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function all($columns = ['*']);

    /**
     * @param int $perPage
     * @param array $columns
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function paginate($perPage = 30, $columns = ['*']);

    /**
     * @return mixed
     */
    public function listsAll();

    /**
     * @param array $data
     */
    public function create(array $data);

    /**
     * @param $id
     * @param array $columns
     * @return mixed
     */
    public function findById($id, $columns = ['*']);

    /**
     * @param array $data
     * @param $id
     */
    public function update(array $data, $id);

    public function lastLoginUpdate($id);

    /**
     *
     */
    public function destroy($id);

    public function getIdByName($name);

    public function getIdByCodeMap($codeMap);
}