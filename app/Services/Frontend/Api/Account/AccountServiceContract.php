<?php
/**
 * Created by PhpStorm.
 * User: K_Hakimboev
 * Date: 19.07.2018
 * Time: 14:00
 */

namespace App\Services\Frontend\Api\Account;

interface AccountServiceContract
{
    const ERROR_BALANCE_NOT_ENOUGH = 'error_balance_not_enough';
    const ERROR_BALANCE_LIMIT_IS_REACHED = 'error_balance_limit_is_reached';
    const ERROR_BLOCKED_BALANCE_LESS_THAN_ZERO = 'error_blocked_balance_less_than_zero';
    const ERROR_BALANCE_LESS_THAN_ZERO = 'error_balance_less_than_zero';
    const ERROR_DAY_LIMIT_IS_REACHED = 'error_day_limit_is_reached';
    const ERROR_WEEK_LIMIT_IS_REACHED = 'error_week_limit_is_reached';
    const ERROR_MONTH_LIMIT_IS_REACHED = 'error_month_limit_is_reached';

    public function createDefaultAccount();

    public function createMerchantAccount();

    public function addToBalance($account, $amount, $transaction);

    public function substractFromBalance($account, $amount, $transaction);

    public function addToBlockedBalance($account, $amount, $transaction);

    public function substractFromBlockedBalance($account, $amount, $transaction);

    public function substractFromBlockedBalanceAndSubstractFromBalance($account, $amount, $transaction);

    public function operateBalance($account, $amount, $transaction, $mode, $mathOperator = 1);

    public function generateAccountNumber();

    public function checkBalanceForPay($account, $amount, $user);

    public function checkBalanceForFill($account, $amount, $user);

    public function checkLimits($amount, $user, $save = false);
    
    public function createBonusAccount($user_id);
    
    public function generateBonusAccountNumber();

    public function createAccountWithTypeAndUserId($account_type, $user_id);
}
