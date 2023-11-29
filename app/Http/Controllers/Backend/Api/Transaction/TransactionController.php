<?php

namespace App\Http\Controllers\Backend\Api\Transaction;

use App\Exceptions\Backend\Api\ResourceNotFoundException;
use App\Exceptions\Frontend\Api\BaseException;
use App\Http\Controllers\Controller;
use App\Services\Common\Gateway\Queue\QueueHashContract;
use App\Services\Frontend\Api\Transaction\TransactionServiceContract;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use App\Services\Frontend\Api\Account\AccountService;

class TransactionController extends Controller
{
    protected $transactionService;
    protected $hash;

    public function __construct(TransactionServiceContract $transactionService, QueueHashContract $hash)
    {
        $this->transactionService = $transactionService;
        $this->hash = $hash;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws ResourceNotFoundException
     */
    public function changeStatusAndCalculateBalance(Request $request)
    {
        if (!in_array($request->getClientIp(), config('app_settings.allowed_ips_for_change_transaction_status')))
            throw new ResourceNotFoundException('Ip not allowed '. $request->getClientIp());

        $success = false;
        $message = '';
        $errors = null;
        $validator = Validator::make($request->all(), [
            'payload.transaction_id' => 'required|alpha_dash',
            'payload.status_id' => 'required|alpha_dash',
            'payload.status_detail_id' => 'required|alpha_dash',
            'payload.comment' => 'string',
            'hash' => 'alpha_num',
            'datetime' => 'required|date_format:ymdHis|after:yesterday',
        ]);

        if ($validator->fails()) {

            $success = false;
            $message = 'Validation error';
            $errors = $validator->errors()->all();

            return \response()->json(compact('success', 'errors'));
        }

        $req = $validator->getData();

        if (\App::environment() == 'production') {
            if (!$this->hash->check($req['hash'] ?? null, $req['datetime'], $req['payload'])) {

                $success = false;
                $message = 'Invalid hash';

                return \response()->json(compact('success', 'message'));

            }
        }

        try {
            
            $this->transactionService->changeStatusAndCalculateBalance($req['payload']);
            
            $success = true;
            $message = 'Успешно';

        } catch (BaseException $e) {
            $success = true;
            $message = 'ERROR_UNCATCHED_EXCEPTION';

            if (isset($e->getAttribute()['error_code'])) {
                switch ($e->getAttribute()['error_code']) {
                    case $this->transactionService::ERROR_SERVICE_NOT_FOUND:
                        $success = false;
                        $message = 'ERROR_SERVICE_NOT_FOUND';
                        break;
                    case $this->transactionService::ERROR_NOT_IDENTIFIED_SERVICE_ACCESS_DENIED:
                        $success = false;
                        $message = 'ERROR_NOT_IDENTIFIED_SERVICE_ACCESS_DENIED';
                        break;
                    case $this->transactionService::ERROR_TO_ACCOUNT_PHONE_NOT_FOUND:
                        $success = false;
                        $message = 'ERROR_TO_ACCOUNT_PHONE_NOT_FOUND';
                        break;
                    case $this->transactionService::ERROR_TO_ACCOUNT_GET_BY_PHONE_NOT_FOUND:
                        $success = false;
                        $message = 'ERROR_TO_ACCOUNT_GET_BY_PHONE_NOT_FOUND';
                        break;
                    case $this->transactionService::ERROR_SERVICE_PARAMS_VALIDATION:
                        $success = false;
                        $message = 'ERROR_SERVICE_PARAMS_VALIDATION';
                        break;
                    case $this->transactionService::ERROR_SERVICE_IS_NOT_ACTIVE:
                        $success = false;
                        $message = 'ERROR_SERVICE_IS_NOT_ACTIVE';
                        break;
                    case $this->transactionService::ERROR_SERVICE_IS_NOT_ACTIVE_IN_THIS_WORKDAY:
                        $success = false;
                        $message = 'ERROR_SERVICE_IS_NOT_ACTIVE_IN_THIS_WORKDAY';
                        break;
                    case $this->transactionService::ERROR_SESSION_SMS_TIMEOUT:
                        $success = false;
                        $message = 'ERROR_SESSION_SMS_TIMEOUT';
                        break;
                    case $this->transactionService::ERROR_FAILED_HASH_CODE_CONFIRM:
                        $success = false;
                        $message = 'ERROR_FAILED_HASH_CODE_CONFIRM';
                        break;
                    case $this->transactionService::ERROR_TEMPORARY_BLOCKED_SMS:
                        $success = false;
                        $message = 'ERROR_TEMPORARY_BLOCKED_SMS';
                        break;
                    case $this->transactionService::ERROR_APP_KEY_LENGTH_INCORRECT:
                        $success = false;
                        $message = 'ERROR_APP_KEY_LENGTH_INCORRECT';
                        break;
                    case $this->transactionService::ERROR_USER_BY_PHONE_NOT_FOUND:
                        $success = false;
                        $message = 'ERROR_USER_BY_PHONE_NOT_FOUND';
                        break;
                    case $this->transactionService::ERROR_TO_ACCOUNT_NOT_FOUND:
                        $success = false;
                        $message = 'ERROR_TO_ACCOUNT_NOT_FOUND';
                        break;
                    case $this->transactionService::ERROR_FROM_ACCOUNT_NOT_FOUND:
                        $success = false;
                        $message = 'ERROR_FROM_ACCOUNT_NOT_FOUND';
                        break;
                    case $this->transactionService::ERROR_TO_USER_NOT_FOUND:
                        $success = false;
                        $message = 'ERROR_TO_USER_NOT_FOUND';
                        break;
                    case $this->transactionService::ERROR_IS_ALREADY_VERIFIED:
                        $success = false;
                        $message = 'ERROR_IS_ALREADY_VERIFIED';
                        break;
                    case $this->transactionService::ERROR_TRANSACTION_NOT_FOUND:
                        $success = false;
                        $message = 'ERROR_TRANSACTION_NOT_FOUND';
                        break;
                    case $this->transactionService::ERROR_STATUS_TRANSACTION_IS_ALLREADY_COMPLETED:
                        $success = true;
                        $message = 'ERROR_STATUS_TRANSACTION_IS_ALLREADY_COMPLETED';
                        break;
                    case $this->transactionService::ERROR_STATUS_TRANSACTION_COMPLETED_CANNOT_BE_REJECTED:
                        $success = false;
                        $message = 'ERROR_STATUS_TRANSACTION_COMPLETED_CANNOT_BE_REJECTED';
                        break;
                    case $this->transactionService::ERROR_STATUS_TRANSACTION_IS_NOT_COMPLETED:
                        $success = false;
                        $message = 'ERROR_STATUS_TRANSACTION_IS_NOT_COMPLETED';
                        break;
                    case $this->transactionService::ERROR_BALANCE_NOT_ENOUGH:
                        $success = false;
                        $message = 'ERROR_BALANCE_NOT_ENOUGH';
                        break;
                    case $this->transactionService::ERROR_BALANCE_LIMIT_IS_REACHED:
                        $success = false;
                        $message = 'ERROR_BALANCE_LIMIT_IS_REACHED';
                        break;
                    case $this->transactionService::ERROR_DAY_LIMIT_IS_REACHED:
                        $success = false;
                        $message = 'ERROR_DAY_LIMIT_IS_REACHED';
                        break;
                    case $this->transactionService::ERROR_WEEK_LIMIT_IS_REACHED:
                        $success = false;
                        $message = 'ERROR_WEEK_LIMIT_IS_REACHED';
                        break;
                    case $this->transactionService::ERROR_MONTH_LIMIT_IS_REACHED:
                        $success = false;
                        $message = 'ERROR_MONTH_LIMIT_IS_REACHED';
                        break;
                    case $this->transactionService::ERROR_COMMISSION_DOES_NOT_MATCH:
                        $success = false;
                        $message = 'ERROR_COMMISSION_DOES_NOT_MATCH';
                        break;
                    case $this->transactionService::ERROR_SELF_PAYMENT_NOT_ALLOWED:
                        $success = false;
                        $message = 'ERROR_SELF_PAYMENT_NOT_ALLOWED';
                        break;
                    case $this->transactionService::ERROR_NOT_IDENTIFIED_SERVICE_ACCESS_DENIED:
                        $success = false;
                        $message = 'ERROR_NOT_IDENTIFIED_SERVICE_ACCESS_DENIED';
                        break;
                    case $this->transactionService::ERROR_IS_ALREADY_VERIFIED_WHERE_RETRY_SMS:
                        $success = false;
                        $message = 'ERROR_IS_ALREADY_VERIFIED_WHERE_RETRY_SMS';
                        break;
                    case $this->transactionService::WARNING_ON_CHANGE_STATUS_CHAIN:
                        $success = true;
                        $message = 'WARNING_ON_CHANGE_STATUS_CHAIN';
                        break;
                    case $this->transactionService::ERROR_TRANSACTION_STATUS_NOT_FOUND:
                        $success = false;
                        $message = 'ERROR_TRANSACTION_STATUS_NOT_FOUND';
                    case AccountService::ERROR_BLOCKED_BALANCE_LESS_THAN_ZERO:
                        $success = false;
                        $message = 'ERROR_BLOCKED_BALANCE_LESS_THAN_ZERO';
                    case AccountService::ERROR_BALANCE_LESS_THAN_ZERO:
                        $success = false;
                        $message = 'ERROR_BALANCE_LESS_THAN_ZERO';
                        break;
                    default:
                }
            }

            Log::error('[Queue Change Status ERROR_UNCATCHED_EXCEPTION]: ' . (($e->getAttribute()['error_code'])??null) .' - ' . $e->getMessage() . $e->getTraceAsString());

        } catch (\Exception $e) {
            $success = false;
            $message = 'ERROR_UNHANDLED_EXCEPTION';
            Log::error('[Queue Change Status ERROR_UNHANDLED_EXCEPTION]: ' . $e->getMessage() . $e->getTraceAsString());
        }

        return \response()->json(compact('success', 'errors', 'message'));
    }

}
