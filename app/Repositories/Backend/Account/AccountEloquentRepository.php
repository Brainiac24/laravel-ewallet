<?php
/**
 * Created by PhpStorm.
 * User: F_Kosimov
 * Date: 18.07.2018
 * Time: 15:10
 */

namespace App\Repositories\Backend\Account;

use App\Models\Account\Account;
use App\Models\Account\Filters\AccountFilter;


class AccountEloquentRepository implements AccountRepositoryContract
{
    protected $account;

    public function __construct(Account $account)
    {
        $this->account = $account;
    }

    public function getForDataTable()
    {

    }

    public function all($columns = ['*'])
    {
        return $account = $this->account->get($columns);
    }

    public function paginate($data = [], $perPage = 30, $columns = ['*'])
    {
        return $this->account
            ->select($columns)
            ->orderBy('created_at', 'desc')
            ->withoutGlobalScopes()
            ->with('user', 'account_type', 'currency', 'accountHistories','account_status')
            ->filterBy(new AccountFilter($data))
            ->paginate($perPage);
    }

    public function listsAll()
    {
        return $this->account->withoutGlobalScopes()->get()->pluck('name', 'id');
    }

    public function create(array $data)
    {
        return $this->account->create($data);
    }

    public function findById($id, $columns = ['*'])
    {
        return $this->account->select($columns)->withoutGlobalScopes()->findOrFail($id);
    }
    public function findWalletByUserId($id, $columns = ['*'])
    {
        return $this->account->select($columns)->withoutGlobalScopes()->where('user_id',$id)->where('account_type_id',config('app_settings.default_wallet_account_type_id'))->first();
    }
    public function update(array $data, $id)
    {
        $account = $this->account->withoutGlobalScopes()->findOrFail($id);
        $account->update($data);
        return $account;
    }

    public function lastLoginUpdate($id)
    {

    }

    public function destroy($id)
    {
        return $this->account->withoutGlobalScopes()->findOrFail($id)->delete();
    }

    public function account_historiesByNumber($number)
    {
        return $accountHistories = $this->account->with('account_histories')->where('number', $number)->get();

    }


    public function updateAccCode($id, $acc_code)
    {
        $account = $this->account->withoutGlobalScopes()->findOrFail($id);

        $data = $account->params_json;
        $data['acc_code'] = $acc_code;
        $account->params_json = $data;
        $account->save();
        return $account;
    }

    public function findByIdAndLockForUpdate($id, $columns = ['*']){
        return $this->account->select($columns)->withoutGlobalScopes()->lockForUpdate()->findOrFail($id);
    }
}