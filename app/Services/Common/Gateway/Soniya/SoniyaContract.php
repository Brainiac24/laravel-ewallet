<?php
/**
 * Created by PhpStorm.
 * User: F_Kosimov
 * Date: 06.09.2018
 * Time: 11:28
 */

namespace App\Services\Common\Gateway\Soniya;


interface SoniyaContract
{

    const ERROR_WRONG_LOGIN_OR_PASSWORD = 'error_wrong_login_or_password';
    const ERROR_HASH_MISMATCH = 'error_hash_mismatch';
    //const ERROR_ACCOUNT_IS_NOT_ACTIVE = 'error_account_is_not_active';
    //const ERROR_BALANCE_LIMIT_IS_REACHED = 'error_balance_limit_is_reached';

    public function pay($result);
    public function check($result);
    public function test($result, $user_id);

}