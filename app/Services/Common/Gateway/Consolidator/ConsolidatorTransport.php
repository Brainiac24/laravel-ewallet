<?php
/**
 * Created by PhpStorm.
 * User: F_Kosimov
 * Date: 31.08.2018
 * Time: 13:34
 */

namespace App\Services\Common\Gateway\Consolidator;

use App\Exceptions\Frontend\Api\ValidationException;
use App\Models\User\User;
use App\Repositories\Backend\Transaction\TransactionRepositoryContract;
use App\Repositories\Backend\User\UserRepositoryContract;
use App\Repositories\Backend\User\UserServiceLimit\UserServiceLimitRepositoryContract;
use App\Services\Common\Helpers\Attestation;
use App\Services\Common\Helpers\Service;
use App\Services\Frontend\Api\Transaction\TransactionServiceContract;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use PhpOffice\PhpSpreadsheet\Shared\StringHelper;

class ConsolidatorTransport implements ConsolidatorContract
{
    protected $consolidator;
    protected $user;
    protected $userServiceLimit;
    protected $transactionRepository;
    protected $transactionService;

    public function __construct(UserRepositoryContract $user, UserServiceLimitRepositoryContract $userServiceLimit, TransactionRepositoryContract $transactionRepository, TransactionServiceContract $transactionService)
    {
        $this->consolidator = config('consolidator.result_array');
        $this->user = $user;
        $this->userServiceLimit = $userServiceLimit;
        $this->transactionRepository = $transactionRepository;
        $this->transactionService = $transactionService;
    }

    public function pay($data)
    {
        $calculatedHash = null;
        $fill = null;
        $service_type = null;
        $secret = null;
        DB::beginTransaction();
        try {
            //wrong server login
            if ($data['provid'] == config('consolidator.server_login') ) {
                $service_type = Service::FILL_EWALLET_ESKHATA;
                $secret = config('consolidator.server_secret_key');
            }elseif ($data['provid'] == config('consolidator.sberbank_login') ) {
                $service_type = Service::FILL_SBERBANK;
                $secret = config('consolidator.sberbank_secret_key');
            }else {
                //dd($currentUser->msisdn);
                throw (new ValidationException(trans('consolidator.errors.wrong_login_or_password')))->setAttribute(['error_code' => self::ERROR_WRONG_LOGIN_OR_PASSWORD]);
            }
            //ini_set("precision",14);
            //dd((float)$data['summa']);
            //Pay Hash String Check Validation
            //key = MD5(provid+secretkey+contractid+summa+date+tranzid)   FUNCTION CHECK
            $calculatedHash = md5($data['provid'] . $secret . $data['contractid'] .$data['summa'] . $data['date'] . $data['tranzid']);
            if ($calculatedHash !== $data['key']) {
                //IF HASH KEY IS BROKEN

                throw (new ValidationException(trans('consolidator.errors.hash_mismatch')))->setAttribute(['error_code' => self::ERROR_HASH_MISMATCH]);
            }

            $fill = $this->transactionService->fill([
                'service_id' => $service_type,
                'amount' => $data['summa'],
                'params' => [
                    [
                        'key' => 'to_account',
                        'value' => (string)$data['contractid'],
                    ],
                ],
                'session_in' => $data['tranzid'],
                'payload_request' => $data,

            ]);

            if ($fill) {
                //RIGHT ANSWER
                $this->consolidator['status'] = 40;
                $this->consolidator['msg'] = 'TRANSACTION CREATED. REGISTERED ID: ' . $fill->id;
                Log::info('[Payment GET OK]:  To User: ' . $data['contractid'] . " SUMM:" . $data['summa'] . " With TranzID:" . $data['tranzid']);
                DB::commit();
                return $this->consolidator;
            } else {
                //ERROR ANSWER
                $this->consolidator['status'] = 10;
                $this->consolidator['msg'] = 'UNKNOWN ERROR. TRANSACTION IS NOT CREATED';
                Log::alert('[Payment GET EMPTY]:  To User: ' . $data['contractid'] . " SUMM:" . $data['summa'] . " With TranzID:" . $data['tranzid']);
                DB::rollBack();
                return $this->consolidator;
            }

        } catch (\App\Exceptions\Frontend\Api\BaseException $e) {

            if (isset($e->getAttribute()['error_code'])) {

                switch ($e->getAttribute()['error_code']) {
                    case $this->transactionService::ERROR_SERVICE_NOT_FOUND:
                        $this->consolidator['status'] = 1;
                        $this->consolidator['msg'] = 'ERROR_SERVICE_NOT_FOUND';
                        break;
                    case $this->transactionService::ERROR_NOT_IDENTIFIED_SERVICE_ACCESS_DENIED:
                        $this->consolidator['status'] = 20;
                        $this->consolidator['msg'] = 'ERROR_NOT_IDENTIFIED_SERVICE_ACCESS_DENIED';
                        break;
                    case $this->transactionService::ERROR_TO_ACCOUNT_PHONE_NOT_FOUND:
                        $this->consolidator['status'] = 14;
                        $this->consolidator['msg'] = 'ERROR_TO_ACCOUNT_PHONE_NOT_FOUND';
                        break;
                    case $this->transactionService::ERROR_TO_ACCOUNT_GET_BY_PHONE_NOT_FOUND:
                        $this->consolidator['status'] = 14;
                        $this->consolidator['msg'] = 'ERROR_TO_ACCOUNT_GET_BY_PHONE_NOT_FOUND';
                        break;
                    case $this->transactionService::ERROR_SERVICE_PARAMS_VALIDATION:
                        $this->consolidator['status'] = 1;
                        $this->consolidator['msg'] = 'ERROR_SERVICE_PARAMS_VALIDATION';
                        break;
                    case $this->transactionService::ERROR_SERVICE_IS_NOT_ACTIVE:
                        $this->consolidator['status'] = 1;
                        $this->consolidator['msg'] = 'ERROR_SERVICE_PARAMS_VALIDATION';
                        break;
                    case $this->transactionService::ERROR_SERVICE_IS_NOT_ACTIVE_IN_THIS_WORKDAY:
                        $this->consolidator['status'] = 1;
                        $this->consolidator['msg'] = 'ERROR_SERVICE_IS_NOT_ACTIVE_IN_THIS_WORKDAY';
                        break;
                    case $this->transactionService::ERROR_SESSION_SMS_TIMEOUT:
                        $this->consolidator['status'] = 1;
                        $this->consolidator['msg'] = 'ERROR_SESSION_SMS_TIMEOUT';
                        break;
                    case $this->transactionService::ERROR_FAILED_HASH_CODE_CONFIRM:
                        $this->consolidator['status'] = 1;
                        $this->consolidator['msg'] = 'ERROR_FAILED_HASH_CODE_CONFIRM';
                        break;
                    case $this->transactionService::ERROR_TEMPORARY_BLOCKED_SMS:
                        $this->consolidator['status'] = 1;
                        $this->consolidator['msg'] = 'ERROR_TEMPORARY_BLOCKED_SMS';
                        break;
                    case $this->transactionService::ERROR_APP_KEY_LENGTH_INCORRECT:
                        $this->consolidator['status'] = 1;
                        $this->consolidator['msg'] = 'ERROR_APP_KEY_LENGTH_INCORRECT';
                        break;
                    case $this->transactionService::ERROR_USER_BY_PHONE_NOT_FOUND:
                        $this->consolidator['status'] = 1;
                        $this->consolidator['msg'] = 'ERROR_USER_BY_PHONE_NOT_FOUND';
                        break;
                    case $this->transactionService::ERROR_TO_ACCOUNT_NOT_FOUND:
                        $this->consolidator['status'] = 1;
                        $this->consolidator['msg'] = 'ERROR_TO_ACCOUNT_NOT_FOUND';
                        break;
                    case $this->transactionService::ERROR_FROM_ACCOUNT_NOT_FOUND:
                        $this->consolidator['status'] = 1;
                        $this->consolidator['msg'] = 'ERROR_FROM_ACCOUNT_NOT_FOUND';
                        break;
                    case $this->transactionService::ERROR_TO_USER_NOT_FOUND:
                        $this->consolidator['status'] = 1;
                        $this->consolidator['msg'] = 'ERROR_TO_USER_NOT_FOUND';
                        break;
                    case $this->transactionService::ERROR_TO_USER_IS_NOT_ACTIVE:
                        $this->consolidator['status'] = 1;
                        $this->consolidator['msg'] = 'ERROR_TO_USER_IS_NOT_ACTIVE';
                        break;
                    case $this->transactionService::ERROR_IS_ALREADY_VERIFIED:
                        $this->consolidator['status'] = 1;
                        $this->consolidator['msg'] = 'ERROR_IS_ALREADY_VERIFIED';
                        break;
                    case $this->transactionService::ERROR_TRANSACTION_NOT_FOUND:
                        $this->consolidator['status'] = 1;
                        $this->consolidator['msg'] = 'ERROR_TRANSACTION_NOT_FOUND';
                        break;
                    case $this->transactionService::ERROR_STATUS_TRANSACTION_IS_ALLREADY_COMPLETED:
                        $this->consolidator['status'] = 1;
                        $this->consolidator['msg'] = 'ERROR_STATUS_TRANSACTION_IS_ALLREADY_COMPLETED';
                        break;
                    case $this->transactionService::ERROR_STATUS_TRANSACTION_COMPLETED_CANNOT_BE_REJECTED:
                        $this->consolidator['status'] = 1;
                        $this->consolidator['msg'] = 'ERROR_STATUS_TRANSACTION_COMPLETED_CANNOT_BE_REJECTED';
                        break;
                    case $this->transactionService::ERROR_STATUS_TRANSACTION_IS_NOT_COMPLETED:
                        $this->consolidator['status'] = 1;
                        $this->consolidator['msg'] = 'ERROR_STATUS_TRANSACTION_IS_NOT_COMPLETED';
                        break;
                    case $this->transactionService::ERROR_BALANCE_NOT_ENOUGH:
                        $this->consolidator['status'] = 20;
                        $this->consolidator['msg'] = 'ERROR_BALANCE_NOT_ENOUGH';
                        break;
                    case $this->transactionService::ERROR_BALANCE_LIMIT_IS_REACHED:
                        $this->consolidator['status'] = 20;
                        $this->consolidator['msg'] = 'ERROR_BALANCE_LIMIT_IS_REACHED';
                        break;
                    case $this->transactionService::ERROR_DAY_LIMIT_IS_REACHED:
                        $this->consolidator['status'] = 20;
                        $this->consolidator['msg'] = 'ERROR_DAY_LIMIT_IS_REACHED';
                        break;
                    case $this->transactionService::ERROR_WEEK_LIMIT_IS_REACHED:
                        $this->consolidator['status'] = 20;
                        $this->consolidator['msg'] = 'ERROR_WEEK_LIMIT_IS_REACHED';
                        break;
                    case $this->transactionService::ERROR_MONTH_LIMIT_IS_REACHED:
                        $this->consolidator['status'] = 20;
                        $this->consolidator['msg'] = 'ERROR_MONTH_LIMIT_IS_REACHED';
                        break;
                    case $this->transactionService::ERROR_COMMISSION_DOES_NOT_MATCH:
                        $this->consolidator['status'] = 1;
                        $this->consolidator['msg'] = 'ERROR_COMMISSION_DOES_NOT_MATCH';
                        break;
                    case $this->transactionService::ERROR_TRANSACTION_IS_ALREADY_EXIST:
                        $this->consolidator['status'] = 51;
                        $this->consolidator['msg'] = "ERROR_TRANSACTION_IS_ALREADY_EXIST";
                        break;
                    case $this->transactionService::ERROR_SELF_PAYMENT_NOT_ALLOWED:
                        $this->consolidator['status'] = 1;
                        $this->consolidator['msg'] = 'ERROR_SELF_PAYMENT_NOT_ALLOWED';
                        break;
                    case self::ERROR_WRONG_LOGIN_OR_PASSWORD:
                        $this->consolidator['status'] = 11;
                        $this->consolidator['msg'] = 'ERROR_WRONG_LOGIN_OR_PASSWORD';
                        break;
                    case self::ERROR_HASH_MISMATCH:
                        $this->consolidator['status'] = 12;
                        $this->consolidator['msg'] = 'ERROR_HASH_MISMATCH '. $calculatedHash . (\App::environment('local') ? $calculatedHash : '');
                        break;
                    default:
                        $this->consolidator['status'] = 10;
                        $this->consolidator['msg'] = $e->getMessage();
                        Log::error('[Payment ERROR]: ' . $e->getMessage() . $e->getTraceAsString());
                }
            } else {
                $this->consolidator['status'] = 10;
                $this->consolidator['msg'] = $e->getMessage();
                Log::error('[Payment ERROR]: ' . $e->getMessage() . $e->getTraceAsString());
            }

            DB::rollBack();
            return $this->consolidator;
        } catch (\Exception $e) {
            $this->consolidator['status'] = 10;
            $this->consolidator['msg'] = $e->getMessage();
            Log::error('[Payment ERROR]: ' . $e->getMessage() . $e->getTraceAsString());
            DB::rollBack();
            return $this->consolidator;
        }

    }

    public function check($data)
    {
        try {
            $secret = null;
            $fill_type = null;
            //wrong server login
            if ($data['provid'] == config('consolidator.server_login')){
                $secret = config('consolidator.server_secret_key');
                $fill_type = "EWALLET";
            } elseif ($data['provid'] == config('consolidator.sberbank_login')) {
                $secret = config('consolidator.sberbank_secret_key');
                $fill_type = "SBERBANK";
            }else{
                $this->consolidator['status'] = 11;
                $this->consolidator['msg'] = 'Не правильный логин или пароль';
                return $this->consolidator;
            }

           
            //Check Hash String
            //key = md5(provid + secretkey + contractid + date)   FUNCTION CHECK
            $calculatedHash = md5($data['provid'] . $secret . $data['contractid'] . $data['date']);
            if ($calculatedHash !== $data['key']) {
                //IF HASH KEY IS BROKEN
                $this->consolidator['status'] = 12;
                $this->consolidator['msg'] = 'Не правильный логин или пароль. Хеш не действителен. '. $calculatedHash . (\App::environment('local') ? $calculatedHash : '');
                return $this->consolidator;
            }
            $currentUser = $this->user->findByMSISDN($data['contractid']);
            if ($currentUser !== null && $currentUser->is_active != 1) {
                //if user blocked
                $this->consolidator['status'] = 20;
                $this->consolidator['msg'] = 'Аккаунт блокирован для пополнения';
                return $this->consolidator;
            }elseif ($currentUser !== null && $fill_type == "SBERBANK" && $currentUser->attestation_id == Attestation::IDENTIFIED) {
                $this->consolidator['status'] = 30;
                $this->consolidator['msg'] = $currentUser->first_name . " " . $currentUser->last_name . " " . $currentUser->middle_name;
            } elseif($currentUser !== null && $fill_type == "SBERBANK" && $currentUser->attestation_id == Attestation::NOT_IDENTIFIED) {
                $this->consolidator['status'] = 14;
                $this->consolidator['msg'] = 'Пользователь: ' . $data['contractid'] . ' не идентифицирован.';
            }elseif ($currentUser !== null && $fill_type == "EWALLET") {
                $resultString = config('consolidator.messages')['1'];
                $currentUserBalanceLimit = $currentUser->attestation->params_json['balance']['limit']; // BALANCE_LIMIT
                $currentUserBalance = $currentUser->accountsWithoutGlobalScope[0]->balance; // BALANCE_LIMIT
                $resultString = str_replace("[!MSISDN!]", $currentUser->msisdn, $resultString);
                $resultString = str_replace("[!FIRST_NAME!]", $this->mask($currentUser->first_name), $resultString);
                $resultString = str_replace("[!MIDDLE_NAME!]", $this->mask($currentUser->middle_name), $resultString);
                $resultString = str_replace("[!LAST_NAME!]", $this->mask($currentUser->last_name), $resultString);
                $resultString = str_replace("[!BALANCE!]", $currentUserBalance, $resultString);
                $resultString = str_replace("[!LIMIT!]", $currentUserBalanceLimit, $resultString);
                $resultString = str_replace("[!CAN_REFIL!]", $currentUserBalanceLimit - $currentUserBalance, $resultString);
                $this->consolidator['status'] = 30;
                $this->consolidator['msg'] = $resultString;
                $this->consolidator['client_status'] = StringHelper::strToLower($currentUser->attestation->code);
                $this->consolidator['client_full_name'] = $currentUser->full_name_lite;
            } else {
                //Miss Number
                $this->consolidator['status'] = 14;
                $this->consolidator['msg'] = 'Номер: ' . $data['contractid'] . ' не найден.';
            }

            return $this->consolidator;
        } catch (\Exception $e) {
            $this->consolidator['status'] = 10;
            $this->consolidator['msg'] = $e->getMessage();
            Log::error('[Payment ERROR]: ' . $e->getMessage());
            return $this->consolidator;
        }
    }

    public function mask($str, $start = 2)
    {
        $length = strlen($str) - 4;
        $mask = preg_replace("/\S/", "*", $str);
        if (is_null($length)) {
            $mask = substr($mask, $start);
            $str = substr_replace($str, $mask, $start);
        } else {
            $mask = substr($mask, $start, $length);
            $str = substr_replace($str, $mask, $start, $length);
        }
        return $str;
    }
}
