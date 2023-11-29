<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 16.07.2019
 * Time: 9:03
 */

namespace App\Repositories\Backend\Account\AccountCategoryType;


use App\Models\AccountCategoryType\AccountCategoryType;

class AccountCategoryTypeEloquentRepository implements AccountCategoryTypeContract
{

    protected $accountCategoryType;

    public function __construct(AccountCategoryType $accountCategoryType)
    {
        $this->accountCategoryType = $accountCategoryType;
    }

    public function all($columns = ['*'])
    {
        return $accountCategoryType = $this->accountCategoryType->get($columns);
    }

    public function findById($id)
    {
        return $this->accountCategoryType->findOrFail($id);
    }

    public function update(array $data, $id)
    {
        $data['params_json'] = json_decode($data['params_json']);
        $accountCategoryType = $this->accountCategoryType->findOrFail($id);
        $accountCategoryType->setOldAttributes($accountCategoryType->getAttributes());
        $accountCategoryType->update($data);
        return $accountCategoryType;
    }
}