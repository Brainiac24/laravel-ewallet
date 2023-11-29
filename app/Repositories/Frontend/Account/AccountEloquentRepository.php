<?php

namespace App\Repositories\Frontend\Account;

use App\Models\Account\Account;
use App\Repositories\Frontend\Account\AccountRepositoryContract;
use App\Services\Common\Helpers\AccountTypes;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;

class AccountEloquentRepository implements AccountRepositoryContract
{
    protected $account;

    public function __construct(Account $account)
    {
        $this->account = $account;
    }

    public function all($columns = ['*'])
    {
        return $this->account->get($columns);
    }

    public function getBalanceByNumber($number)
    {
        return $this->account->with(['account_type', 'currency', 'user'])->where('number', $number)->first();
    }

    public function getByNumber($number)
    {
        //dd($number);
        return $this->account->where('number', $number)->first();
    }
    public function getByIdWithoutGlobalScopes($id)
    {
        return $this->account->with('user')->withoutGlobalScopes()->find($id)->first();
    }
    public function getByNumberAndLockForUpdate($number, $user_id)
    {
        return $this->account->where('number', $number)->where('user_id', $user_id)->lockForUpdate()->first();
    }
    public function getByNumberAndLockForUpdateWithoutGlobalScopes($number, $user_id)
    {
        return $this->account->where('number', $number)->where('user_id', $user_id)->withoutGlobalScopes()->lockForUpdate()->first();
    }

    public function getByTypeId($detailTypeId)
    {
        return $this->account->where('account_type_id', $detailTypeId)->first();
    }

    public function getDefaultWalletAccountByUserId($user_id)
    {
        //dd($user_id);
        return $this->account->where('user_id', $user_id)->where('account_type_id', config('app_settings.default_wallet_account_type_id'))->withoutGlobalScopes()->first();
    }

    public function getDefaultWalletAccountByUserIdAndLockForUpdate($user_id)
    {
        //dd($user_id);

        return $this->account->with("user.attestation")->where('user_id', $user_id)->where('account_type_id', config('app_settings.default_wallet_account_type_id'))->withoutGlobalScopes()->lockForUpdate()->first();
    }

    public function getBonusAccountByUserIdWithoutGlobalScopes($user_id){
        return $this->account->where('user_id', $user_id)->where('account_type_id', AccountTypes::EWALLET_BONUS)->withoutGlobalScopes()->first();
    }


}