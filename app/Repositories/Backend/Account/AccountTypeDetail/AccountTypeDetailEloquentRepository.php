<?php
/**
 * Created by PhpStorm.
 * User: F_Kosimov
 * Date: 18.07.2018
 * Time: 15:10
 */

namespace App\Repositories\Backend\Account\AccountTypeDetail;

use App\Models\Account\AccountTypeDetail\AccountTypeDetail;

class AccountTypeDetailEloquentRepository implements AccountTypeDetailRepositoryContract
{
    protected $accountTypeDetail;

    public function __construct(AccountTypeDetail $accountTypeDetail)
    {
        $this->accountTypeDetail = $accountTypeDetail;
    }

    public function getForDataTable()
    {

    }

    public function all($columns = ['*'])
    {
        return $accountTypeDetail = $this->accountTypeDetail->get($columns);
    }

    public function paginate($perPage = 30, $columns = ['*'])
    {
        return $this->accountTypeDetail->select($columns)->with('accountType')->orderBy('created_at', 'desc')->paginate($perPage);
    }

    public function listsAll()
    {
        return $this->accountTypeDetail->get()->pluck('name', 'id');
    }

    public function create(array $data)
    {
        return $this->accountTypeDetail->create($data);
    }

    public function findById($id, $columns = ['*'])
    {
        return $this->accountTypeDetail->select($columns)->findOrFail($id);
    }

    public function update(array $data, $id)
    {
        $accountTypeDetail = $this->accountTypeDetail->findOrFail($id);
        $accountTypeDetail->update($data);
    }

    public function lastLoginUpdate($id)
    {

    }

    public function destroy($id)
    {
        $this->accountTypeDetail->findOrFail($id)->delete();
    }

    public function getIdByName($name)
    {
        return $this->accountTypeDetail->where('name', $name)->first();
    }
}