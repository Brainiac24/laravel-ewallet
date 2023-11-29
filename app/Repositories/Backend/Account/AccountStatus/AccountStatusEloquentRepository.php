<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 05.04.2019
 * Time: 15:38
 */

namespace App\Repositories\Backend\Account\AccountStatus;

use App\Models\Account\AccountStatus\AccountStatus;

class AccountStatusEloquentRepository implements AccountStatusRepositoryContract
{

    /**
     * @var AccountStatus
     */
    private $accountStatus;

    public function __construct(AccountStatus $accountStatus)
    {
        $this->accountStatus = $accountStatus;
    }

    public function all()
    {
        return $this->accountStatus->get();
    }

    /**
     * @param $id
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model
     */
    public function findById($id)
    {
        return $this->accountStatus->findOrFail($id);
    }


    public function update(array $data, $id)
    {
        $accountStatus = $this->accountStatus->findOrFail($id);
        $accountStatus->setOldAttributes($accountStatus->getAttributes());
        $accountStatus->update($data);
        return $accountStatus;
    }

    public function create(array $data)
    {
        return $this->accountStatus->create($data);
    }

    public function destroy($id)
    {
        $accountStatus = $this->accountStatus->findOrFail($id);
        $accountStatus->is_active = 0;
        $accountStatus->save();
        return $accountStatus;
    }

    public function getIdByCodeMap($codeMap)
    {
        return $this->accountStatus->where('code_map', $codeMap)->first();
    }

    public function getIdByName($name)
    {
        return $this->accountStatus->where('name', $name)->first();
    }
}