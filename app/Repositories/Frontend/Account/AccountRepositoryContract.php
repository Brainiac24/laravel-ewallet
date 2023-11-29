<?php

namespace App\Repositories\Frontend\Account;

interface AccountRepositoryContract
{
    public function all($columns = ['*']);
    public function getBalanceByNumber($number);
    public function getByNumber($number);
    public function getByIdWithoutGlobalScopes($id);
    public function getByNumberAndLockForUpdate($number, $user_id);
    public function getByNumberAndLockForUpdateWithoutGlobalScopes($number, $user_id);
    public function getByTypeId($detailTypeId);
    public function getDefaultWalletAccountByUserId($user_id);
    public function getDefaultWalletAccountByUserIdAndLockForUpdate($user_id);

    public function getBonusAccountByUserIdWithoutGlobalScopes($user_id);

}