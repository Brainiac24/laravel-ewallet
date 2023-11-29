<?php
/**
 * Created by PhpStorm.
 * User: F_Kosimov
 * Date: 18.07.2018
 * Time: 15:10
 */

namespace App\Repositories\Backend\Account\AccountType;

use App\Models\Account\AccountType\AccountType;
use App\Models\Account\AccountType\Filters\AccountTypeFilter;

class AccountTypeEloquentRepository implements AccountTypeRepositoryContract
{
    protected $accountType;

    public function getAll($search)
    {
        return $this->accountType->where('name', 'like', '%' . $search . '%')->orderBy('name')->get();
    }

    public function __construct(AccountType $accountType)
    {
        $this->accountType = $accountType;
    }

    public function getForDataTable()
    {

    }

    public function all($columns = ['*'])
    {
        return $accountType = $this->accountType->get($columns);
    }

    public function paginate($data = [], $perPage = 30, $columns = ['*'])
    {
        return $this->accountType->select($columns)->with('gateway')->orderBy('created_at', 'desc')
            ->filterBy(new AccountTypeFilter($data))->paginate($perPage);
    }

    public function listsAll()
    {
        return $this->accountType->get()->pluck('name', 'id');
    }

    public function create(array $data)
    {
        $data['params_json'] = json_decode($data['params_json']);
        return $this->accountType->create($data);
    }

    public function findById($id, $columns = ['*'])
    {
        return $this->accountType->select($columns)->findOrFail($id);
    }

    public function update(array $data, $id)
    {
        $data['params_json'] = json_decode($data['params_json']);
        $accountType = $this->accountType->findOrFail($id);
        $accountType->setOldAttributes($accountType->getAttributes());
        $accountType->update($data);
        return $accountType;
    }

    public function lastLoginUpdate($id)
    {

    }

    public function destroy($id)
    {
        return $this->accountType->findOrFail($id)->delete();
    }

    public function getIdByName($name)
    {
        return $this->accountType->where('name', $name)->first();
    }

    public function getIdByCodeMap($codeMap)
    {
        return $this->accountType->where('code_map', $codeMap)->first();
    }

    public function imgUncoloredListsAll()
    {
        return $this->accountType
            ->orderBy('img_uncolored', 'ASC')
            ->distinct("img_uncolored")->get()
            ->pluck('img_uncolored', 'img_uncolored');
    }

    public function imgColoredListsAll()
    {
        return $this->accountType
            ->orderBy('img_colored', 'ASC')
            ->distinct("img_colored")->get()
            ->pluck('img_colored', 'img_colored');
    }
}