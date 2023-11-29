<?php

namespace App\Services\Frontend\Api\Account;

use App\Events\Frontend\Account\AccountHistory\AccountModifiedEvent;
use App\Exceptions\Frontend\Api\LimitException;
use App\Exceptions\Frontend\Api\LogicException;
use App\Models\Account\Account;
use App\Repositories\Frontend\Account\AccountRepositoryContract;
use App\Repositories\Frontend\Setting\SettingRepositoryContract;
use App\Repositories\Frontend\User\Attestation\AttestationRepositoryContract;
use App\Repositories\Frontend\User\UserRepositoryContract;
use App\Services\Common\Helpers\AccountTypes;
use App\Services\Common\Helpers\Setting;
use App\Services\Frontend\Api\Account\AccountServiceContract;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AccountService implements AccountServiceContract
{
    protected $accountRepository;
    protected $userRepository;
    protected $attestationRepository;
    protected $settingRepository;

    const BALANCE_AMOUNT = '1';
    const BLOCKED_AMOUNT = '2';
    const CONFIRM_AMOUNT = '3';

    public function __construct(AccountRepositoryContract $accountRepository, UserRepositoryContract $userRepository, AttestationRepositoryContract $attestationRepository, SettingRepositoryContract $settingRepository)
    {
        $this->accountRepository = $accountRepository;
        $this->userRepository = $userRepository;
        $this->attestationRepository = $attestationRepository;
        $this->settingRepository = $settingRepository;
    }

    public function createDefaultAccount()
    {
        $account = $this->accountRepository->getByTypeId(config('app_settings.default_wallet_account_type_id'));

        if ($account == null) {
            $account = new Account();
            $account->number = $this->generateAccountNumber();
            $account->balance = 0;
            $account->blocked_balance = 0;
            $account->account_type_id = config('app_settings.default_wallet_account_type_id');
            $account->currency_id = config('app_settings.default_currency_id');
            $account->user_id = Auth::id();
            $account->save();
        }

        return $account;
    }

    public function addToBalance($account, $amount, $transaction)
    {
        return $this->operateBalance($account, $amount, $transaction, self::BALANCE_AMOUNT, 1);
    }

    public function substractFromBalance($account, $amount, $transaction)
    {
        return $this->operateBalance($account, $amount, $transaction, self::BALANCE_AMOUNT, -1);
    }

    public function addToBlockedBalance($account, $amount, $transaction)
    {
        return $this->operateBalance($account, $amount, $transaction, self::BLOCKED_AMOUNT, 1);
    }

    public function substractFromBlockedBalance($account, $amount, $transaction)
    {
        return $this->operateBalance($account, $amount, $transaction, self::BLOCKED_AMOUNT, -1);
    }

    public function substractFromBlockedBalanceAndSubstractFromBalance($account, $amount, $transaction)
    {
        return $this->operateBalance($account, $amount, $transaction, self::CONFIRM_AMOUNT, 1);
    }

    public function operateBalance($account, $amount, $transaction, $mode, $mathOperator = 1)
    {
        $sum = round(($mathOperator * ((double) $amount)), 4);

        switch ($mode) {
            case self::BALANCE_AMOUNT:
                $account->balance += $sum;
                break;
            case self::BLOCKED_AMOUNT:
                $account->blocked_balance += $sum;
                break;
            case self::CONFIRM_AMOUNT:
                $account->balance -= $sum;
                $account->blocked_balance -= $sum;
                break;
            default:
        }

        if ($account->blocked_balance < 0) {
            throw (new LogicException(trans('accounts.errors.blocked_balance_less_than_zero')))->setAttribute(['error_code' => self::ERROR_BLOCKED_BALANCE_LESS_THAN_ZERO]);
        }

        if ($account->balance < 0) {
            throw (new LogicException(trans('accounts.errors.balance_less_than_zero')))->setAttribute(['error_code' => self::ERROR_BALANCE_LESS_THAN_ZERO]);
        }

        $account->save();

        event(new AccountModifiedEvent($account, $transaction));

        return $account;
    }

    public function generateAccountNumber()
    {
        $setting = $this->settingRepository->findByKeyAndLockForUpdate(Setting::ACCOUNT_COUNTER);
        //dd($setting->value);
        $counter = $setting->value + 1;

        $setting->value = (string) $counter;
        $setting->save();
        return (string) $counter;

        //return sprintf('4444972%d', rand(100000000, 999999999));
    }

    public function generateBonusAccountNumber()
    {
        $setting = $this->settingRepository->findByKeyAndLockForUpdate(Setting::BONUS_ACCOUNT_COUNTER);
        //dd($setting->value);
        $counter = $setting->value + 1;

        $setting->value = (string) $counter;
        $setting->save();
        return (string) $counter;

        //return sprintf('4444972%d', rand(100000000, 999999999));
    }

    public function checkLimits($amount, $user, $save = false)
    {

        $limits = $user->limits_json;
        //dd($user);
        $account = $user->accountsWithoutGlobalScope[0];

        $carbon = new Carbon();
        //Создание дефолтных полей лимитов если параметр лимитов полей отсутствуют у пользователя
        if ($limits == null) {
            $attestation = $this->attestationRepository->getDefaultAttestation();
            $limits = [];
            foreach ($attestation->params_json as $key => $value) {
                if ($key != 'balance') {
                    $limits += [
                        $key => [
                            'limit' => 0,
                            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                        ],
                    ];
                }

            }
        }

        //Калькуляция и заполнение(+проверка) лимитов согласно запросу
        foreach ($limits as $key => &$value) {

            switch ($key) {
                case 'day':
                    if ($carbon->parse($value['updated_at'])->toDateString() < $carbon->now()->toDateString()) {
                        if (((double) $amount) <= ((double) $user->attestation->params_json['day']['limit'])) {
                            $value['updated_at'] = $carbon->now()->toDateTimeString();
                            $value['limit'] = ((double) $amount);
                        } else {

                            throw (new LimitException(trans('attestations.errors.day_limit_is_reached', ['attribute' => $user->attestation->params_json['day']['limit']])))->setAttribute(['error_code' => self::ERROR_DAY_LIMIT_IS_REACHED]);
                        }
                    } else {
                        //dd($value['limit']);
                        if ((((double) $value['limit']) + ((double) $amount)) <= ((double) $user->attestation->params_json['day']['limit'])) {
                            $value['updated_at'] = $carbon->now()->toDateTimeString();
                            $value['limit'] = ((double) $value['limit']) + ((double) $amount);
                        } else {
                            throw (new LimitException(trans('attestations.errors.day_limit_is_reached', ['attribute' => ((double) $user->attestation->params_json['day']['limit']) - ((double) $value['limit'])])))->setAttribute(['error_code' => self::ERROR_DAY_LIMIT_IS_REACHED]);
                        }
                    }

                    break;
                case 'week':
                    if ($carbon->parse($value['updated_at'])->weekOfYear < $carbon->now()->weekOfYear || $carbon->parse($value['updated_at'])->year < $carbon->now()->year) {
                        if (((double) $amount) <= ((double) $user->attestation->params_json['week']['limit'])) {
                            $value['updated_at'] = $carbon->now()->toDateTimeString();
                            $value['limit'] = ((double) $amount);
                            //dd($user->attestation->params_json['week']['limit']);
                        } else {
                            throw (new LimitException(trans('attestations.errors.week_limit_is_reached', ['attribute' => $user->attestation->params_json['week']['limit']])))->setAttribute(['error_code' => self::ERROR_WEEK_LIMIT_IS_REACHED]);
                        }
                    } else {
                        if ((((double) $value['limit']) + ((double) $amount)) <= ((double) $user->attestation->params_json['week']['limit'])) {

                            //$value['updated_at'] = $carbon->now()->toDateTimeString();
                            $value['limit'] = ((double) $value['limit']) + ((double) $amount);
                        } else {
                            throw (new LimitException(trans('attestations.errors.week_limit_is_reached', ['attribute' => ((double) $user->attestation->params_json['week']['limit']) - ((double) $value['limit'])])))->setAttribute(['error_code' => self::ERROR_WEEK_LIMIT_IS_REACHED]);
                        }
                    }

                    break;
                case 'month':
                    if ($carbon->parse($value['updated_at'])->month < $carbon->now()->month || $carbon->parse($value['updated_at'])->year < $carbon->now()->year) {
                        if (((double) $amount) <= ((double) $user->attestation->params_json['month']['limit'])) {
                            $value['updated_at'] = $carbon->now()->toDateTimeString();
                            $value['limit'] = ((double) $amount);
                        } else {
                            throw (new LimitException(trans('attestations.errors.month_limit_is_reached', ['attribute' => $user->attestation->params_json['month']['limit']])))->setAttribute(['error_code' => self::ERROR_MONTH_LIMIT_IS_REACHED]);
                        }
                    } else {
                        if ((((double) $value['limit']) + ((double) $amount)) <= ((double) $user->attestation->params_json['month']['limit'])) {
                            //$value['updated_at'] = $carbon->now()->toDateTimeString();
                            $value['limit'] = ((double) $value['limit']) + ((double) $amount);
                        } else {
                            throw (new LimitException(trans('attestations.errors.month_limit_is_reached', ['attribute' => ((double) $user->attestation->params_json['month']['limit']) - ((double) $value['limit'])])))->setAttribute(['error_code' => self::ERROR_MONTH_LIMIT_IS_REACHED]);
                        }
                    }
                    break;
                /*case 'balance':
                $value['updated_at'] = $carbon->now()->toDateTimeString();
                $value['limit'] = $account->balance;
                //dd($account->balance - $amount);
                break;*/
                default:
            }
        }

        if ($save) {
            $user->limits_json = $limits;
            $user->save();
            //event(new UserModifiedEvent($transaction, Events::USER_LIMITS_CHANGED));
        }

        return $limits;

    }

    /*public function calculateTransaction($transaction, $account)
    {
    if (!$isAnotherUser) {
    $account = $this->addToBlockedBalance($account, $transaction->amount_all, $isAnotherUser);
    } else {
    $account = $this->addToBlockedBalance($account, $transaction->amount, $isAnotherUser);
    }
    }

    /* public function calculateTransactionRealBalance($transaction, $account)
    {
    if (!$isAnotherUser) {
    $account = $this->addToBalance($account, $transaction->amount_all, $isAnotherUser);
    } else {
    $account = $this->addToBalance($account, $transaction->amount, $isAnotherUser);
    }
    }

    public function calculateTransactionBalanceFromBoth($transaction, $account)
    {
    if (!$isAnotherUser) {
    $account = $this->addToBlockedBalance($account, $transaction->amount_all, $isAnotherUser);
    $account = $this->addToBalance($account, $transaction->amount_all, $isAnotherUser);
    } else {
    $account = $this->addToBlockedBalance($account, $transaction->amount, $isAnotherUser);
    $account = $this->addToBalance($account, $transaction->amount, $isAnotherUser);
    }
    }*/

    public function checkBalanceForPay($account, $amount, $user)
    {
        //dd(($account->balance + $amount) > ((double) $user->attestation->params_json['balance']['limit']));
        if (($account->balance - $account->blocked_balance - $amount) < 0) {
            throw (new LimitException(trans('accounts.errors.balance_not_enough')))->setAttribute(['error_code' => self::ERROR_BALANCE_NOT_ENOUGH]);
        }
        if (($account->balance - $account->blocked_balance) < $amount) {
            throw (new LimitException(trans('accounts.errors.balance_not_enough')))->setAttribute(['error_code' => self::ERROR_BALANCE_NOT_ENOUGH]);
        }
    }

    public function checkBalanceForPayForChangeStatus($account, $amount, $user)
    {
        Log::info('[LOG_BALANCE_NOT_ENOUGH]: account_id=' . $account->id . ' blocked_balance=' . $account->blocked_balance . ' amount=' . $amount);
        //dd(($account->balance + $amount) > ((double) $user->attestation->params_json['balance']['limit']));
        if (($account->blocked_balance - $amount) < 0) {
            throw (new LimitException(trans('accounts.errors.balance_not_enough')))->setAttribute(['error_code' => self::ERROR_BALANCE_NOT_ENOUGH]);
        }
        if (($account->blocked_balance) < $amount) {
            throw (new LimitException(trans('accounts.errors.balance_not_enough')))->setAttribute(['error_code' => self::ERROR_BALANCE_NOT_ENOUGH]);
        }
    }

    public function checkBalanceForFill($account, $amount, $user)
    {
        if (($account->balance + $amount) > ((double) $user->attestation->params_json['balance']['limit'])) {
            throw (new LimitException(trans('attestations.errors.balance_limit_is_reached')))->setAttribute(['error_code' => self::ERROR_BALANCE_LIMIT_IS_REACHED]);
        }
    }

    public function createMerchantAccount()
    {
        $account = new Account();
        $account->number = $this->generateAccountNumber();
        $account->balance = 0;
        //$account->params_json = ['acc_code'=>$acc_code];
        $account->blocked_balance = 0;
        $account->account_type_id = AccountTypes::MERCHANT; //config('app_settings.default_merchant_id');
        $account->currency_id = config('app_settings.default_currency_id');
        $account->user_id = config('app_settings.default_merchant_user_id');
        $account->save();

        $accounts['account_id'] = $account->id;

        $account = new Account();
        $account->number = $this->generateAccountNumber();
        $account->balance = 0;
        $account->blocked_balance = 0;
        $account->account_type_id = AccountTypes::VIRTUAL_MERCHANT; //config('app_settings.default_merchant_id');
        $account->currency_id = config('app_settings.default_currency_id');
        $account->user_id = config('app_settings.default_merchant_user_id');
        $account->save();

        $accounts['transit_account_id'] = $account->id;
        return $accounts;
    }

    public function createBonusAccount($user_id)
    {

        $account = $this->accountRepository->getBonusAccountByUserIdWithoutGlobalScopes(AccountTypes::EWALLET_BONUS);

        if ($account == null) {
            $account = new Account();
            $account->number = $this->generateBonusAccountNumber();
            $account->balance = 0;
            $account->blocked_balance = 0;
            $account->account_type_id = AccountTypes::EWALLET_BONUS;
            $account->currency_id = config('app_settings.default_currency_id');
            $account->user_id = $user_id;
            $account->save();
        }

        return $account;
    }

    public function createAccountWithTypeAndUserId($account_type, $user_id)
    {
        $account = new Account();
        $account->number = $this->generateAccountNumber();
        $account->balance = 0;
        $account->blocked_balance = 0;
        $account->account_type_id = $account_type;
        $account->currency_id = config('app_settings.default_currency_id');
        $account->user_id = $user_id;
        $account->save();

        return $account;
    }
}
