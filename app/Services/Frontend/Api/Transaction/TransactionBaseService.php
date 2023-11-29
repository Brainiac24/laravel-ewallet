<?php

namespace App\Services\Frontend\Api\Transaction;

use App\Exceptions\Frontend\Api\LogicException;
use App\Exceptions\Frontend\Api\TimeoutException;
use App\Exceptions\Frontend\Api\ValidationException;
use App\Exceptions\Frontend\Api\WaitingException;
use App\Notifications\User\SendSmsCodeForConfirmTransaction;
use App\Repositories\Frontend\Account\AccountRepositoryContract;
use App\Repositories\Frontend\Currency\CurrencyRate\CurrencyRateRepositoryContract;
use App\Repositories\Frontend\Currency\CurrencyRepositoryContract;
use App\Repositories\Frontend\Favorite\FavoriteRepositoryContract;
use App\Repositories\Frontend\Service\ServiceRepositoryContract;
use App\Repositories\Frontend\Transaction\TransactionRepositoryContract;
use App\Repositories\Frontend\User\UserRepositoryContract;
use App\Services\Common\Gateway\Processing\ProcessingTransportContract;
use App\Services\Common\Gateway\Queue\QueueTransporterContract;
use App\Services\Common\Helpers\Platform;
use App\Services\Frontend\Api\Account\AccountServiceContract;
use App\Services\Frontend\Api\Commission\CommissionService;
use App\Services\Frontend\Api\User\UserServiceLimit\UserServiceLimitServiceContract;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

abstract class TransactionBaseService implements TransactionServiceContract
{

    //use PhoneBaseAuthService;

    protected $transactionRepository;
    protected $serviceRepository;
    protected $accountRepository;
    protected $userRepository;
    protected $currencyRepository;
    protected $currencyRateRepository;
    protected $accountService;
    protected $commissionService;
    protected $userServiceLimitService;
    protected $processingTransport;
    protected $queueTransport;
    protected $favoriteRepository;

    public function __construct(
        TransactionRepositoryContract $transactionRepository,
        ServiceRepositoryContract $serviceRepository,
        AccountRepositoryContract $accountRepository,
        UserRepositoryContract $userRepository,
        CurrencyRepositoryContract $currencyRepository,
        CurrencyRateRepositoryContract $currencyRateRepository,
        AccountServiceContract $accountService,
        UserServiceLimitServiceContract $userServiceLimitService,
        CommissionService $commissionService,
        ProcessingTransportContract $processingTransport,
        QueueTransporterContract $queueTransport,
        FavoriteRepositoryContract $favoriteRepository
    ) {
        $this->transactionRepository = $transactionRepository;
        $this->serviceRepository = $serviceRepository;
        $this->accountRepository = $accountRepository;
        $this->userRepository = $userRepository;
        $this->currencyRepository = $currencyRepository;
        $this->currencyRateRepository = $currencyRateRepository;
        $this->accountService = $accountService;
        $this->commissionService = $commissionService;
        $this->userServiceLimitService = $userServiceLimitService;
        $this->processingTransport = $processingTransport;
        $this->queueTransport = $queueTransport;
        $this->favoriteRepository = $favoriteRepository;
    }

    public function getPhoneFromParams(array $params)
    {

        $phone = null;
        foreach ($params as $key => $value) {

            if ($value['key'] == 'to_account') {
                $phone = $value['value'];
            }
        }
        //dd($phone);
        return $phone;
    }

    /**
     * @param $service
     * @return bool
     * @throws ValidationException
     */

    public function checkServiceWorkday($service)
    {
        if (!$service->is_active) {
            throw (new ValidationException(trans('service.errors.service_is_not_active')))->setAttribute(['error_code' => self::ERROR_SERVICE_IS_NOT_ACTIVE]);
        }
        $res = false;
        $now = Carbon::now();
        $weekday = strtolower($now->format('l'));
        $workday = null;
        
        if ($service->workday != null) {
            $workday = $service->workday->toArray();
            if (!empty($workday[$weekday])) {
                $hour_arr = explode('-', $workday[$weekday]);
                //dd($hour_arr[0]);
                if ((int) $now->format('H') < (int) $hour_arr[0] || (int) $now->format('H') > (int) $hour_arr[1]) {
                    throw (new ValidationException(trans('service.errors.service_is_not_active_in_this_workday')))->setAttribute(['error_code' => self::ERROR_SERVICE_IS_NOT_ACTIVE_IN_THIS_WORKDAY]);
                }
            }
        }

        return $res;
    }

    /**
     * @param $sms_code
     */
    public function sendSmsCode($sms_code)
    {
        Auth::user()->notify(new SendSmsCodeForConfirmTransaction($sms_code));
    }

    /**
     * @param $transaction
     * @throws TimeoutException
     */
    public function isExpiredSmsCode($transaction)
    {
        $now = Carbon::now();
        $smsCodeSendAt = $transaction->sms_code_sent_at->addSeconds(config('queue_transporter.sms.timeout_confirm_code'));
        if ($now->diffInSeconds($smsCodeSendAt, false) < 0) {
            throw (new TimeoutException(trans('queue.session_sms_timeout')))->setAttribute(['error_code' => self::ERROR_SESSION_SMS_TIMEOUT]);
        }
    }

    /**
     * @param $transaction
     * @param $user
     * @param string $hashCode
     * @param string $token
     * @param string $deviceId
     * @param bool $platform
     * @throws ValidationException
     * @throws WaitingException
     */
    public function checkHashSmsCode($transaction, $user, $hashCode, $token, $deviceId, $platform)
    {
        //dd($platform);
        //dd(strtolower($this->makeHash($token, $transaction->sms_code, $deviceId, $platform)));
        $transaction->sms_confirm_try_count += 1;
        $transaction->sms_confirm_try_at = Carbon::now();
        $transaction->save();
        if (strtolower($hashCode) !== strtolower($this->makeHash($token, $transaction->sms_code, $deviceId, $platform))) {

            $this->checkLimitSmsConfirmTryCount($user, $transaction);
            throw (new ValidationException(trans('queue.failed_code_confirm')))->setAttribute(['error_code' => self::ERROR_FAILED_HASH_CODE_CONFIRM]);
        }
    }

    /**
     * @param $user
     * @param $transaction
     * @throws WaitingException
     */
    protected function checkLimitSmsConfirmTryCount($user, $transaction)
    {
        if (config('queue_transporter.sms.confirm_try_count') <= $transaction->sms_confirm_try_count) {
            $user = $this->blockUser($user);
            throw (new WaitingException(trans('queue.temporary_blocked_sms', ['attribute' => Carbon::now()->diffForHumans($user->unblock_at, true)])))->setAttribute(['error_code' => self::ERROR_TEMPORARY_BLOCKED_SMS]);
        }
    }

    /**
     * @param $user
     * @return mixed
     */
    protected function blockUser($user)
    {
        $now = Carbon::now();
        $user->blocked_count += 1;
        $user->blocked_at = $now;
        $user->unblock_at = $now->addMinutes(($user->blocked_count * $user->blocked_count) * config('queue_transporter.sms.interval_lock'));
        $user->ip = \Request::ip();

        $user->save();

        return $user;
    }

    /**
     * @param string $token
     * @param string $code
     * @param string $deviceId
     * @param bool $platform
     * @return string
     * @throws LogicException
     */
    public function makeHash($token, $code, $deviceId, $platform)
    {
        $key = $this->getAppKey($platform);
        //dd(sprintf('%s:%s:%s:%s', $token, $code, $deviceId, $key));
        return hash('sha256', sprintf('%s:%s:%s:%s', $token, $code, $deviceId, $key));
    }

    /**
     * @param bool $platform
     * @return string
     * @throws LogicException
     */
    protected function getAppKey($platform)
    {
        $key = null;
        switch ($platform) {
            case Platform::IOS:
                $key = config('auth_api.ios_key');
                break;
            case Platform::ANDROID:
                $key = config('auth_api.android_key');
                break;
        }

        if (strlen($key) !== 32) {
            throw (new LogicException('App key length incorrect'))->setAttribute(['error_code' => self::ERROR_APP_KEY_LENGTH_INCORRECT]);
        }

        return $key;
    }

    public function getMainParamValue($transaction)
    {
        $params_value = null;
        foreach ($transaction->service->params_json as $value) {

            foreach ($transaction->params_json as $value2) {
                //dd($value2);
                if (isset($value['is_main'])) {
                    if ($value['is_main'] == 1 && $value['input_name'] == $value2['key']) {
                        $params_value = $value2;
                    }
                }
            }
        }

        if ($params_value == null) {
            if (isset($transaction->params_json[0])) {
                $params_value = $transaction->params_json[0];
            }
        }

        return $params_value['value'];

    }

    public function validateServiceParams($service, &$request)
    {
        //dd($service);
        $transaction_params['params'] = [];
        $check_params = [];
        $params_rules = [];
        foreach ($service->params_json as $service_params) {
            $params_position = 0;
            foreach ($request['params'] as $request_params) {

                if ($service_params['input_name'] == $request_params['key']) {
                    $regexp = $service_params['regexp'];
                    if($regexp==null){
                        $regexp = '[-_.0-9A-Za-zА-Яа-яЁё]{2,255}';
                    }
                    //dd($regexp);

                    $check_params[$request_params['key']] = $request_params['value'];
                    $transaction_params['params'][] = [
                        'key' => $request_params['key'],
                        'value' => $request_params['value'],
                    ];
                    $regexp_arr = null;
                    $regexp_arr[] = 'regex:/^' . $regexp . '$/u';

                    //dd($regexp_arr);
                    $params_rules += [
                        $request_params['key'] => array_prepend($regexp_arr, 'required'),
                    ];
                }
                $params_position++;
            }
        }

        if (empty($transaction_params['params'])) {
            throw (new ValidationException(trans('service.errors.validate_params_empty')))->setAttribute(['error_code' => self::ERROR_SERVICE_PARAMS_EMPTY]);
        }

        $validator = Validator::make($check_params, $params_rules);

        if ($validator->fails()) {
            //$success = false;
            $errors = $validator->errors()->all();
            $err_exp = (new ValidationException(trans('service.errors.validate_params_reqexp')))->setAttribute(['error_code' => self::ERROR_SERVICE_PARAMS_VALIDATION]);
            $err_exp->setAttribute(['errors' => $errors]);
            throw $err_exp;

        } else {
            $request['params'] = $transaction_params['params'];
            //dd($request);
        }
    }

    public function isExpiredSendSmsCode($transaction)
    {
        $now = Carbon::now();
        // проверка времени смс для повторной отправки
        if ($transaction->sms_code_sent_at === null)
            return;

        $smsCodeSendAt = $this->addWaitingRetrySeconds($transaction->sms_code_sent_at);
        $diffHuman = $now->diffForHumans($smsCodeSendAt, true);
        if ($now->diffInSeconds($smsCodeSendAt, false) > 0) {
            $wait_seconds = $now->diffInSeconds($this->addWaitingRetrySeconds($transaction->sms_code_sent_at));
            $error = new  WaitingException(trans('transaction.errors.temporary_sms_blocked', ['attribute' => $diffHuman]));
            $error->setAttribute(['meta' => ['wait_seconds' => $wait_seconds]]);

            throw $error;
        }
    }

    protected function addWaitingRetrySeconds(Carbon $carbon): Carbon
    {
        return $carbon->addSeconds(config('auth_api.sms.waiting_to_retry_send'));
    }

}
