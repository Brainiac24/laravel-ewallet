<?php

namespace App\Services\Frontend\Api\Transaction;

use App\Events\Frontend\Transaction\TransactionHistory\TransactionModifiedEvent;
use App\Events\Frontend\User\UserHistory\UserModifiedEvent;
use App\Exceptions\Frontend\Api\BaseException;
use App\Exceptions\Frontend\Api\LogicException;
use App\Exceptions\Frontend\Api\TransactionAllreadyCompletedException;
use App\Exceptions\Frontend\Api\ValidationException;
use App\Notifications\Transaction\SendTransactionStatusFillRejected;
use App\Notifications\Transaction\SendTransactionStatusFillSuccess;
use App\Notifications\Transaction\SendTransactionStatusPayRejected;
use App\Notifications\Transaction\SendTransactionStatusPaySuccess;
use App\Notifications\Transaction\SendTransactionStatusReturnSuccess;
use App\Services\Common\Gateway\Queue\QueueHandlerEnum;
use App\Services\Common\Helpers\Attestation;
use App\Services\Common\Helpers\Events;
use App\Services\Common\Helpers\Helper;
use App\Services\Common\Helpers\Service;
use App\Services\Common\Helpers\TransactionStatus;
use App\Services\Common\Helpers\TransactionStatusDetail;
use App\Services\Common\Helpers\TransactionStatusDetail as TransactionStatusDetailStatic;
use App\Services\Common\Helpers\TransactionType as TransactionTypeStatic;
use Illuminate\Database\QueryException;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class TransactionService extends TransactionBaseService implements TransactionServiceContract
{

    /**
     * @param $request
     * @return mixed
     * @throws \Exception
     */
    public function create($request)
    {

        DB::beginTransaction();

        try {
            //dd($request);
            $req = $request;

            $data = array();
            $from_account = null;
            $to_account = null;
            $user = Auth::user()->load('attestation');
            $service = $this->serviceRepository->getByIdActive($req['service_id']);

            if ($service == null) {
                throw (new LogicException(trans('service.errors.code_not_found')))->setAttribute(['error_code' => self::ERROR_SERVICE_NOT_FOUND]);
            }

            if ($user->attestation->id == Attestation::NOT_IDENTIFIED) {
                if ($service->is_enabled == 0) {
                    throw (new LogicException(trans('attestations.errors.not_allowed')))->setAttribute(['error_code' => self::ERROR_NOT_IDENTIFIED_SERVICE_ACCESS_DENIED]);
                }
            }

            $this->validateServiceParams($service, $req);
            //dd($req['params']);
           
            //$this->checkServiceWorkday($service);

            if ($req['amount'] < $service->min_amount || $req['amount'] > $service->max_amount) {
                throw (new LogicException(trans('service.errors.min_max_ammount_not_match')))->setAttribute(['error_code' => self::ERROR_AMMOUNT_NOT_IN_SERVICE_MIN_MAX_VALUE]);
            }

            $data['service_id'] = $service->id;
            $data['amount'] = $req['amount'];
            $data['commission'] = $this->commissionService->calculateCommission($service, $data['amount'], $req['commission']);
            $amount = (double) $data['amount'] + (double) $data['commission'];

            $data['params_json'] = array_values($req['params']);

            $from_account = $this->accountRepository->getByNumberAndLockForUpdate($req['from_account_number'], $user->id);
            if ($from_account == null) {
                throw (new LogicException(trans('accounts.errors.code_not_found')))->setAttribute(['error_code' => self::ERROR_FROM_ACCOUNT_NOT_FOUND]);
            }

            $this->accountService->checkBalanceForPay($from_account, $amount, $user);

            $this->accountService->checkLimits($amount, $user);

            $this->userServiceLimitService->calculateLimits($service, $amount);

            $to_user = null;
            $to_account = null;

            if ($service->is_to_accountable == 1) {
                $phone = $this->getPhoneFromParams($data['params_json']);
                if ($phone == null) {
                    throw (new ValidationException(trans('service.errors.phone_param_not_found')))->setAttribute(['error_code' => self::ERROR_TO_ACCOUNT_PHONE_NOT_FOUND]);
                }
                if ($user->msisdn == $phone) {
                    throw (new LogicException(trans('users.errors.self_payment_not_allowed')))->setAttribute(['error_code' => self::ERROR_SELF_PAYMENT_NOT_ALLOWED]);
                }
                $to_user = $this->userRepository->findByMsisdn($phone);
                if ($to_user == null) {
                    throw (new ValidationException(trans('users.errors.user_by_phone_not_found')))->setAttribute(['error_code' => self::ERROR_TO_ACCOUNT_GET_BY_PHONE_NOT_FOUND]);
                }

                if ($to_user->attestation_id == Attestation::NOT_IDENTIFIED) {
                    throw (new LogicException(trans('attestations.errors.not_identified_not_allowed')))->setAttribute(['error_code' => self::ERROR_NOT_IDENTIFIED_SERVICE_ACCESS_DENIED]);
                }

                $to_account = $this->accountRepository->getDefaultWalletAccountByUserIdAndLockForUpdate($to_user->id);
                $this->accountService->checkBalanceForFill($to_account, $amount, $to_user);
                $data['to_account_id'] = $to_account->id;
            }

            $data['from_account_id'] = $from_account->id;
            $data['account_balance'] = $from_account->balance;
            $data['created_by_user_id'] = $from_account->user_id;
            $data['transaction_type_id'] = config('app_settings.default_transaction_type_id');
            $data['transaction_status_id'] = config('app_settings.default_transaction_status_id');
            $data['transaction_status_detail_id'] = config('app_settings.default_transaction_status_detail_id');
            $data['currency_rate_value'] = $this->currencyRateRepository->getRate()->value_buy;
            $data['currency_iso_name'] = $this->currencyRepository->getById($from_account->currency_id)->iso_name;
            $data['add_to_favorite'] = $req['add_to_favorite']??0;
            $data['device_platform'] = \json_encode($user->devices_json);

            $data['sms_code'] = \App::environment('production') ? Helper::generateSmsCode() : '1234';
            //Helper::generateSmsCode(); //'1234';

            $transaction = $this->transactionRepository->create($data);
            //dd($transaction->getDirty());
            $transaction = $this->transactionRepository->getByIdForShow($transaction->id);
            

            //dd($transaction);
            
            //$transaction->setOldAttributes($transaction->getAttributes());
            

            $this->sendSmsCode($transaction->sms_code);

            $transaction->sms_code_sent_at = Carbon::now();
            $transaction->sms_code_sent_count = 1;
            $transaction->save();

            $transaction->setChanges($transaction->getAttributes());
            event(new TransactionModifiedEvent($transaction));
            event(new UserModifiedEvent($transaction, Events::TRANSACTION_CREATED));

            //$user->notify(new SendTransactionStatusPaySuccess($transaction));
            
            DB::commit();

        } catch (\Exception $e) {
            //dd($e->getAttribute());
            DB::rollBack();
            throw $e;

        }

        return $transaction;

    }

    public function ConfirmSmsAndChangeStatus($request)
    {
        $result = false;
        DB::beginTransaction();
        try {

            $user = Auth::user()->load('attestation');
            $transaction = $this->transactionRepository->getById($request['transaction_id']);

            if ($transaction == null) {
                throw (new LogicException(trans('transactions.errors.not_found')))->setAttribute(['error_code' => self::ERROR_TRANSACTION_NOT_FOUND]);
            }

            if ($transaction->transaction_status_id == TransactionStatus::NOT_VERIFIED) {

                $this->isExpiredSmsCode($transaction);
                //dd($user->devices_json['id']);

                $this->checkHashSmsCode($transaction, $user, $request['hash_code'], $user->user_session->access_token, $user->devices_json['id'], $user->devices_json['platform']);

                $service = $transaction->service;
                if ($service == null) {
                    throw (new LogicException(trans('service.errors.code_not_found')))->setAttribute(['error_code' => self::ERROR_SERVICE_NOT_FOUND]);
                }

                //ХАРДКОД - для apple test
                if ($user->id == config('app_settings.test_apple_client_id')) {
                    $transaction->transaction_status_id = TransactionStatus::REJECTED;
                    $transaction->finished_at = Carbon::now()->format('Y-m-d H:i:s');

                    event(new TransactionModifiedEvent($transaction));
                    event(new UserModifiedEvent($transaction, Events::TRANSACTION_CHANGED));

                    $transaction->save();
                } else {

                    //ХАРДКОД - логика, нужно реализовать таблицу many-to-many
                    if ($user->attestation->id == Attestation::NOT_IDENTIFIED) {
                        if ($service->is_enabled == 0) {
                            throw (new LogicException(trans('attestations.errors.not_identified_not_allowed')))->setAttribute(['error_code' => self::ERROR_NOT_IDENTIFIED_SERVICE_ACCESS_DENIED]);
                        }
                    }

                    $from_account = $this->accountRepository->getByNumberAndLockForUpdate($transaction->from_account->number, $transaction->from_account->user_id);

                    if ($from_account == null) {
                        throw (new LogicException(trans('accounts.errors.code_not_found')))->setAttribute(['error_code' => self::ERROR_FROM_ACCOUNT_NOT_FOUND]);
                    }

                    $this->accountService->checkBalanceForPay($from_account, $transaction->amount_all, Auth::user());

                    $this->accountService->checkLimits($transaction->amount_all, Auth::user(), true);

                    $this->userServiceLimitService->calculateLimits($service, $transaction->amount_all, true);

                    $to_user = null;
                    $to_account = null;

                    if ($service->is_to_accountable == 1) {

                        $to_user = $transaction->to_account_without_g_scopes->user;
                        //dd($to_user);
                        if ($to_user == null) {
                            throw (new ValidationException(trans('user.errors.not_found')))->setAttribute(['error_code' => self::ERROR_TO_USER_NOT_FOUND]);
                        }

                        if ($to_user->attestation_id == Attestation::NOT_IDENTIFIED) {
                            throw (new ValidationException(trans('attestations.errors.not_allowed')))->setAttribute(['error_code' => self::ERROR_NOT_IDENTIFIED_SERVICE_ACCESS_DENIED]);
                        }

                        $to_account = $this->accountRepository->getDefaultWalletAccountByUserIdAndLockForUpdate($to_user->id);
                        $this->accountService->checkBalanceForFill($to_account, $transaction->amount, $to_user);

                        if ($to_account == null) {
                            throw (new LogicException(trans('accounts.errors.code_not_found')))->setAttribute(['error_code' => self::ERROR_TO_ACCOUNT_NOT_FOUND]);
                        }
                    }

                    $transaction->account_balance = $from_account->balance;
                    $transaction->created_by_user_id = Auth::user()->id;

                    //ХАРДКОД - нужно взять getRate по валютам исходя из валюты сервиса
                    $transaction->currency_rate_value = $this->currencyRateRepository->getRate()->value_buy;

                    if ($service->id == Service::EWALLET_ESKHATA) {
                        $transaction->transaction_status_id = TransactionStatus::COMPLETED;
                        $transaction->finished_at = Carbon::now()->format('Y-m-d H:i:s');

                        //$transaction->save();

                        $this->accountService->substractFromBalance($from_account, $transaction->amount_all, $transaction);

                        if ($service->is_to_accountable == 1) {
                            $this->accountService->addToBalance($to_account, $transaction->amount, $transaction);
                        }

                        if ($transaction->add_to_favorite == 1) {

                            $data2['name'] = '';
                            $data2['service_id'] = $transaction->service->id;
                            $data2['amount'] = $transaction->amount;
                            $data2['params'] = $transaction->params_json;

                            $this->favoriteRepository->saveFromCreateTransaction($data2, $transaction->service, $transaction->user);

                        }

                        //event(new TransactionModifiedEvent($transaction));
                        //event(new UserModifiedEvent($transaction, Events::TRANSACTION_CHANGED));

                        $user->notify(new SendTransactionStatusPaySuccess($transaction));

                        $to_user->notify(new SendTransactionStatusFillSuccess($transaction));

                    } else {
                        $transaction->transaction_status_id = TransactionStatus::new;

                        //$transaction->save();

                        $this->accountService->addToBlockedBalance($from_account, $transaction->amount_all, $transaction);

                        //event(new TransactionModifiedEvent($transaction));
                        //event(new UserModifiedEvent($transaction, Events::TRANSACTION_CHANGED));

                    }

                    if ($service->id == Service::EWALLET_ESKHATA) {

                        $transaction->is_queued = 2;
                        $transaction->save();

                        event(new TransactionModifiedEvent($transaction));
                        event(new UserModifiedEvent($transaction, Events::TRANSACTION_CHANGED));

                        DB::commit();

                        $result = true;

                    } else {

                        $payload = [
                            'id' => $transaction->id,
                            'session_number' => (string) $transaction->session_number,
                            'amount' => (string) $transaction->amount,
                            'processing_code' => (string) $transaction->service->processing_code,
                            'account' => (string) $this->getMainParamValue($transaction),
                            'status' => $transaction->transaction_status_id,
                            'push_token' => $user->devices_json['push_token'] ?? null,
                        ];

                        $queue = $this->queueTransport->send($payload, QueueHandlerEnum::PROCESSING);

                        $transaction->is_queued = 1;
                        
                        if (isset($queue['success']) && $queue['success']) {
                            $transaction->is_queued = 2;
                        }

                        $transaction->save();

                        event(new TransactionModifiedEvent($transaction));
                        event(new UserModifiedEvent($transaction, Events::TRANSACTION_CHANGED));

                        DB::commit();

                        $result = true;

                    }

                }
            } else {
                throw (new LogicException(trans('transactions.errors.is_already_verified')))->setAttribute(['error_code' => self::ERROR_IS_ALREADY_VERIFIED]);
            }
        } catch (\Exception $e) {

            DB::rollBack();
            throw $e;

        }

        return $result;

    }

    public function retrySendSms($id)
    {
        $result = false;
        DB::beginTransaction();
        try {

            $user = Auth::user()->load('attestation');
            //dd($id);
            $transaction = $this->transactionRepository->getById($id);

            if ($transaction == null) {
                throw (new LogicException(trans('transactions.errors.not_found')))->setAttribute(['error_code' => self::ERROR_TRANSACTION_NOT_FOUND]);
            }

            if ($transaction->transaction_status_id == TransactionStatus::NOT_VERIFIED) {

                $this->isExpiredSendSmsCode($transaction);

                $transaction->sms_code = \App::environment('production') ? Helper::generateSmsCode() : '4321';

                $this->sendSmsCode($transaction->sms_code);

                $transaction->sms_code_sent_at = Carbon::now();
                $transaction->sms_code_sent_count = 1;
                $transaction->save();

                event(new TransactionModifiedEvent($transaction));
                event(new UserModifiedEvent($transaction, Events::TRANSACTION_CHANGED));

                DB::commit();

            } else {
                throw (new LogicException(trans('transactions.errors.is_already_verified_where_retry_sms')))->setAttribute(['error_code' => self::ERROR_IS_ALREADY_VERIFIED_WHERE_RETRY_SMS]);
            }
        } catch (\Exception $e) {

            DB::rollBack();
            throw $e;

        }

        return $result;

    }

    public function changeStatusAndCalculateBalance(array $data)
    {
        DB::beginTransaction();
        try {
            $transaction = $this->transactionRepository->getByIdAndLockForUpdateWithoutGlobalScopes($data['transaction_id']);

            if ($transaction == null) {
                throw (new LogicException(trans('transactions.errors.not_found')))->setAttribute(['error_code' => self::ERROR_TRANSACTION_NOT_FOUND]);
            }

            switch ($data['status_id']) {
                case TransactionStatus::PAY_IN_PROCESS:

                    if ($transaction->transaction_status_id == TransactionStatus::new ) {

                        $transaction->transaction_status_id = $data['status_id'];
                        $transaction->transaction_status_detail_id = $data['status_detail_id'];

                    } else {
                        throw (new LogicException(trans('transactions.errors.warning_chain')))->setAttribute(['error_code' => self::WARNING_ON_CHANGE_STATUS_CHAIN]);
                    }
                    break;
                case TransactionStatus::PAY_ACCEPTED:

                    if ($transaction->transaction_status_id == TransactionStatus::PAY_IN_PROCESS || $transaction->transaction_status_id == TransactionStatus::new) {

                        $transaction->transaction_status_id = $data['status_id'];
                        $transaction->transaction_status_detail_id = $data['status_detail_id'];

                    } else {
                        throw (new LogicException(trans('transactions.errors.warning_chain')))->setAttribute(['error_code' => self::WARNING_ON_CHANGE_STATUS_CHAIN]);
                    }

                    break;
                case TransactionStatus::COMPLETED:

                    if ($transaction->transaction_status_id == TransactionStatus::PAY_ACCEPTED || $transaction->transaction_status_id == TransactionStatus::PAY_IN_PROCESS || $transaction->transaction_status_id == TransactionStatus::new) {

                        $transaction->transaction_status_id = $data['status_id'];
                        $transaction->transaction_status_detail_id = $data['status_detail_id'];
                        $transaction->finished_at = Carbon::now()->format('Y-m-d H:i:s');

                        //dd($transaction->from_account_without_g_scopes->number);

                        $from_account = $this->accountRepository->getByNumberAndLockForUpdateWithoutGlobalScopes($transaction->from_account_without_g_scopes->number, $transaction->from_account_without_g_scopes->user_id);

                        if ($from_account == null) {
                            throw (new LogicException(trans('accounts.errors.code_not_found')))->setAttribute(['error_code' => self::ERROR_FROM_ACCOUNT_NOT_FOUND]);
                        }

                        $this->accountService->checkBalanceForPayForChangeStatus($from_account, $transaction->amount_all, $transaction->user);

                        //$this->accountService->checkLimits($transaction->amount_all, $transaction->user);

                        $this->userServiceLimitService->calculateLimits($transaction->service, $transaction->amount_all);

                        $this->accountService->substractFromBlockedBalanceAndSubstractFromBalance($from_account, $transaction->amount_all, $transaction);

                
                        $transaction->user->notify(new SendTransactionStatusPaySuccess($transaction));

                        if ($transaction->service->id == Service::EWALLET_ESKHATA) {

                            $to_user = null;
                            $to_account = null;

                            if ($transaction->service->is_to_accountable == 1) {

                                $to_user = $transaction->to_account_without_g_scopes->user;
                                //dd($to_user);
                                if ($to_user == null) {
                                    throw (new ValidationException(trans('user.errors.not_found')))->setAttribute(['error_code' => self::ERROR_TO_USER_NOT_FOUND]);
                                }

                                $to_account = $this->accountRepository->getDefaultWalletAccountByUserIdAndLockForUpdate($to_user->id);
                                $this->accountService->checkBalanceForFill($to_account, $transaction->amount, $to_user);

                                if ($to_account == null) {
                                    throw (new LogicException(trans('accounts.errors.code_not_found')))->setAttribute(['error_code' => self::ERROR_TO_ACCOUNT_NOT_FOUND]);
                                }
                            }

                            $this->accountService->addToBalance($to_account, $transaction->amount, $transaction);

                            $to_user->notify(new SendTransactionStatusPaySuccess($transaction));

                        }

                        //dd($transaction->add_to_favorite);

                        if ($transaction->add_to_favorite == 1) {

                            $data['name'] = '';
                            $data['service_id'] = $transaction->service->id;
                            $data['amount'] = $transaction->amount;
                            $data['params'] = $transaction->params_json;

                            $this->favoriteRepository->saveFromCreateTransaction($data, $transaction->service, $transaction->user);

                        }

                    } else {
                        throw (new TransactionAllreadyCompletedException(trans('transactions.errors.status_transaction_is_allready_completed')))->setAttribute(['error_code' => self::ERROR_STATUS_TRANSACTION_IS_ALLREADY_COMPLETED]);
                    }

                    break;
                case TransactionStatus::REJECTED:

                    if ($transaction->transaction_status_id == TransactionStatus::PAY_ACCEPTED || $transaction->transaction_status_id == TransactionStatus::PAY_IN_PROCESS || $transaction->transaction_status_id == TransactionStatus::new) {

                        $transaction->transaction_status_id = $data['status_id'];
                        $transaction->transaction_status_detail_id = $data['status_detail_id'];
                        $transaction->finished_at = Carbon::now()->format('Y-m-d H:i:s');

                        $from_account = $this->accountRepository->getByNumberAndLockForUpdateWithoutGlobalScopes($transaction->from_account_without_g_scopes->number, $transaction->from_account_without_g_scopes->user_id);

                        if ($from_account == null) {
                            throw (new LogicException(trans('accounts.errors.code_not_found')))->setAttribute(['error_code' => self::ERROR_FROM_ACCOUNT_NOT_FOUND]);
                        }

                        $this->accountService->checkBalanceForPay($from_account, -1 * $transaction->amount_all, $transaction->user);

                        $this->accountService->checkLimits(-1 * $transaction->amount_all, $transaction->user, true);

                        $this->userServiceLimitService->calculateLimits($transaction->service, -1 * $transaction->amount_all, true);

                        $this->accountService->substractFromBlockedBalance($from_account, $transaction->amount_all, $transaction);

                        $transaction->user->notify(new SendTransactionStatusPayRejected($transaction));

                    } else {
                        throw (new LogicException(trans('transactions.errors.status_transaction_completed_cannot_be_rejected')))->setAttribute(['error_code' => self::ERROR_STATUS_TRANSACTION_COMPLETED_CANNOT_BE_REJECTED]);
                    }
                    break;
                case TransactionStatus::RETURNED:

                    if ($transaction->transaction_status_id == TransactionStatus::COMPLETED) {

                        $transaction->transaction_status_id = TransactionStatus::RETURNED;
                        $transaction->transaction_status_detail_id = TransactionStatusDetail::OK;
                        $transaction->finished_at = Carbon::now()->format('Y-m-d H:i:s');

                        $from_account = $this->accountRepository->getByNumberAndLockForUpdateWithoutGlobalScopes($transaction->from_account_without_g_scopes->number, $transaction->from_account_without_g_scopes->user_id);

                        if ($from_account == null) {
                            throw (new LogicException(trans('accounts.errors.code_not_found')))->setAttribute(['error_code' => self::ERROR_FROM_ACCOUNT_NOT_FOUND]);
                        }

                        $this->accountService->checkBalanceForPay($from_account, -1 * $transaction->amount_all, $transaction->user);

                        $this->accountService->checkLimits(-1 * $transaction->amount_all, $transaction->user, true);

                        $this->userServiceLimitService->calculateLimits($transaction->service, -1 * $transaction->amount_all, true);

                        $this->accountService->addToBalance($from_account, $transaction->amount_all, $transaction);

                        $transaction->user->notify(new SendTransactionStatusReturnSuccess($transaction));

                        if ($transaction->service->id == Service::EWALLET_ESKHATA) {

                            $to_user = null;
                            $to_account = null;

                            if ($transaction->service->is_to_accountable == 1) {

                                $to_user = $transaction->to_account_without_g_scopes->user;
                                //dd($to_user);
                                if ($to_user == null) {
                                    throw (new ValidationException(trans('user.errors.not_found')))->setAttribute(['error_code' => self::ERROR_TO_USER_NOT_FOUND]);
                                }

                                $to_account = $this->accountRepository->getDefaultWalletAccountByUserIdAndLockForUpdate($to_user->id);
                                $this->accountService->checkBalanceForPay($to_account, -1 * $transaction->amount, $to_user);

                                if ($to_account == null) {
                                    throw (new LogicException(trans('accounts.errors.code_not_found')))->setAttribute(['error_code' => self::ERROR_TO_ACCOUNT_NOT_FOUND]);
                                }
                            }

                            $this->accountService->substractFromBalance($to_account, $transaction->amount, $transaction);

                            $to_user->notify(new SendTransactionStatusReturnSuccess($transaction));
                        }
                        //ХАРДКОД - возврат незавершённой транзакции
                    /*}elseif ($transaction->transaction_status_id == TransactionStatus::ACCEPTED) {

                        $transaction->transaction_status_id = TransactionStatus::RETURNED;
                        $transaction->transaction_status_detail_id = TransactionStatusDetail::OK;
                        $transaction->finished_at = Carbon::now()->format('Y-m-d H:i:s');

                        $from_account = $this->accountRepository->getByNumberAndLockForUpdateWithoutGlobalScopes($transaction->from_account_without_g_scopes->number);

                        if ($from_account == null) {
                            throw (new LogicException(trans('accounts.errors.code_not_found')))->setAttribute(['error_code' => self::ERROR_FROM_ACCOUNT_NOT_FOUND]);
                        }

                        $this->accountService->checkBalanceForPay($from_account, -1 * $transaction->amount_all, $transaction->user);

                        $this->accountService->checkLimits(-1 * $transaction->amount_all, $transaction->user, true);

                        $this->userServiceLimitService->calculateLimits($transaction->service, -1 * $transaction->amount_all, true);

                        $this->accountService->substractFromBlockedBalance($from_account, $transaction->amount_all, $transaction);

                        $transaction->user->notify(new SendTransactionStatusPayRejected($transaction));
*/
                    } else {
                        throw (new LogicException(trans('transactions.errors.status_transaction_is_not_completed')))->setAttribute(['error_code' => self::ERROR_STATUS_TRANSACTION_IS_NOT_COMPLETED]);
                    }

                    break;
                default:
                    throw (new ValidationException(trans('transactions.errors.status_transaction_status_not_found')))->setAttribute(['error_code' => self::ERROR_TRANSACTION_STATUS_NOT_FOUND]);

            }

            $transaction->comment = $data['comment'] ?? null;

            $transaction->setOldAttributes($transaction->getAttributes());

            $tran = $transaction->save();
            
            event(new TransactionModifiedEvent($transaction));

            DB::commit();

            return $transaction;

        } catch (BaseException $e) {
            DB::rollBack();
            throw $e;

        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function fill($request)
    {
        $to_user = null;
        $res = false;
        $req = $request;
        DB::beginTransaction();
        try {
            //dd($request);

            $data = array();
            $to_account = null;
            $transaction = null;


            $to_user = $this->userRepository->findByMsisdn($this->getPhoneFromParams($req['params']));

            if ($to_user == null) {
                throw (new ValidationException(trans('users.errors.user_by_phone_not_found')))->setAttribute(['error_code' => self::ERROR_USER_BY_PHONE_NOT_FOUND]);
            }

            if ($to_user != null && $to_user->is_active != 1) {
                throw (new ValidationException(trans('users.errors.user_is_not_active')))->setAttribute(['error_code' => self::ERROR_TO_USER_IS_NOT_ACTIVE]);
            }

            $to_account = $this->accountRepository->getDefaultWalletAccountByUserIdAndLockForUpdate($to_user->id);

            if ($to_account == null) {
                throw (new LogicException(trans('accounts.errors.code_not_found')))->setAttribute(['error_code' => self::ERROR_TO_ACCOUNT_NOT_FOUND]);
            }

            $transaction = $this->transactionRepository->findBySessionInWithoutGlobalScopes($req['session_in']);

            if ($transaction != null) {
                throw (new ValidationException(trans('transactions.errors.is_already_exist')))->setAttribute(['error_code' => self::ERROR_TRANSACTION_IS_ALREADY_EXIST]);
            }

            $service = $this->serviceRepository->findById($req['service_id']);

            if ($service == null) {
                throw (new LogicException(trans('service.errors.code_not_found')))->setAttribute(['error_code' => self::ERROR_SERVICE_NOT_FOUND]);
            }

            $this->validateServiceParams($service, $req);

            $data['service_id'] = $service->id;
            $data['amount'] = $req['amount'];
            $amount = (double) $data['amount'];
            $data['params_json'] = array_values($req['params']);
            $data['finished_at'] = \Carbon\Carbon::now()->format("Y-m-d H:i:s");


            

            
            $this->accountService->checkBalanceForFill($to_account, $amount, $to_user);
            //dd($to_account->id);

            $data['to_account_id'] = $to_account->id;
            $data['account_balance'] = $to_account->balance;
            $data['created_by_user_id'] = config('app_settings.system_user_id');
            $data['transaction_type_id'] = TransactionTypeStatic::FILL;
            $data['transaction_status_id'] = TransactionStatus::COMPLETED;
            $data['transaction_status_detail_id'] = TransactionStatusDetailStatic::OK;
            $data['currency_rate_value'] = $this->currencyRateRepository->getRate()->value_buy;
            $data['currency_iso_name'] = $this->currencyRepository->getById($to_account->currency_id)->iso_name;
            $data['session_in'] = $req['session_in'];
            $data['request'] = $req['payload_request'];
            $data['is_queued'] = 2;

            $transaction = $this->transactionRepository->create($data);

            $transaction = $this->transactionRepository->getByIdWithoutGlobalScopes($transaction->id);

            $this->accountService->addToBalance($to_account, $transaction->amount, $transaction, true);



            event(new TransactionModifiedEvent($transaction));
            event(new UserModifiedEvent($transaction, Events::TRANSACTION_CREATED));

            DB::commit();
            $res = $transaction;

            $to_user->notify(new SendTransactionStatusFillSuccess($transaction));

        } catch (QueryException $ex) {
            $message = $ex;
            throw $ex;
        } catch (\App\Exceptions\Frontend\Api\BaseException $e) {
            $message = 'Неизвестная ошибка';
            if (isset($e->getAttribute()['error_code'])) {
                switch ($e->getAttribute()['error_code']) {
                    case self::ERROR_SERVICE_NOT_FOUND:
                        $message = config('transactions.fill_error_text.error_service_not_found');
                        break;
                    case self::ERROR_NOT_IDENTIFIED_SERVICE_ACCESS_DENIED:
                        $message = config('transactions.fill_error_text.error_not_identified_service_access_denied');
                        break;
                    case self::ERROR_TO_ACCOUNT_PHONE_NOT_FOUND:
                        $message = config('transactions.fill_error_text.error_to_account_phone_not_found');
                        break;
                    case self::ERROR_TO_ACCOUNT_GET_BY_PHONE_NOT_FOUND:
                        $message = config('transactions.fill_error_text.error_to_account_get_by_phone_not_found');
                        break;
                    case self::ERROR_SERVICE_PARAMS_VALIDATION:
                        $message = config('transactions.fill_error_text.error_service_params_validation');
                        break;
                    case self::ERROR_SERVICE_IS_NOT_ACTIVE:
                        $message = config('transactions.fill_error_text.error_service_is_not_active');
                        break;
                    case self::ERROR_SERVICE_IS_NOT_ACTIVE_IN_THIS_WORKDAY:
                        $message = config('transactions.fill_error_text.error_service_is_not_active');
                        break;
                    case self::ERROR_SESSION_SMS_TIMEOUT:
                        $message = config('transactions.fill_error_text.error_session_sms_timeout');
                        break;
                    case self::ERROR_FAILED_HASH_CODE_CONFIRM:
                        $message = config('transactions.fill_error_text.error_failed_hash_code_confirm');
                        break;
                    case self::ERROR_TEMPORARY_BLOCKED_SMS:
                        $message = config('transactions.fill_error_text.error_temporary_blocked_sms');
                        break;
                    case self::ERROR_APP_KEY_LENGTH_INCORRECT:
                        $message = config('transactions.fill_error_text.error_app_key_length_incorrect');
                        break;
                    case self::ERROR_USER_BY_PHONE_NOT_FOUND:
                        $message = config('transactions.fill_error_text.error_user_by_phone_not_found');
                        break;
                    case self::ERROR_TO_ACCOUNT_NOT_FOUND:
                        $message = config('transactions.fill_error_text.error_to_account_not_found');
                        break;
                    case self::ERROR_FROM_ACCOUNT_NOT_FOUND:
                        $message = config('transactions.fill_error_text.error_from_account_not_found');
                        break;
                    case self::ERROR_TO_USER_NOT_FOUND:
                        $message = config('transactions.fill_error_text.error_to_user_not_found');
                        break;
                    case self::ERROR_TO_USER_IS_NOT_ACTIVE:
                        $message = config('transactions.fill_error_text.error_to_user_is_not_active');
                        break;
                    case self::ERROR_IS_ALREADY_VERIFIED:
                        $message = config('transactions.fill_error_text.error_is_already_verified');
                        break;
                    case self::ERROR_TRANSACTION_NOT_FOUND:
                        $message = config('transactions.fill_error_text.error_transaction_not_found');
                        break;
                    case self::ERROR_STATUS_TRANSACTION_IS_ALLREADY_COMPLETED:
                        $message = config('transactions.fill_error_text.error_status_transaction_is_allready_completed');
                        break;
                    case self::ERROR_STATUS_TRANSACTION_COMPLETED_CANNOT_BE_REJECTED:
                        $message = config('transactions.fill_error_text.error_status_transaction_completed_cannot_be_rejected');
                        break;
                    case self::ERROR_STATUS_TRANSACTION_IS_NOT_COMPLETED:
                        $message = config('transactions.fill_error_text.error_status_transaction_is_not_completed');
                        break;
                    case self::ERROR_BALANCE_NOT_ENOUGH:
                        $message = config('transactions.fill_error_text.error_balance_not_enough');
                        break;
                    case self::ERROR_BALANCE_LIMIT_IS_REACHED:
                        $message = config('transactions.fill_error_text.error_balance_limit_is_reached');
                        break;
                    case self::ERROR_DAY_LIMIT_IS_REACHED:
                        $message = config('transactions.fill_error_text.error_day_limit_is_reached');
                        break;
                    case self::ERROR_WEEK_LIMIT_IS_REACHED:
                        $message = config('transactions.fill_error_text.error_week_limit_is_reached');
                        break;
                    case self::ERROR_MONTH_LIMIT_IS_REACHED:
                        $message = config('transactions.fill_error_text.error_month_limit_is_reached');
                        break;
                    case self::ERROR_COMMISSION_DOES_NOT_MATCH:
                        $message = config('transactions.fill_error_text.error_commission_does_not_match');
                        break;
                    case self::ERROR_TRANSACTION_IS_ALREADY_EXIST:
                        $message = config('transactions.fill_error_text.error_transaction_is_already_exist');
                        break;
                    case self::ERROR_SELF_PAYMENT_NOT_ALLOWED:
                        $message = config('transactions.fill_error_text.error_self_payment_not_allowed');
                        break;
                    default:
                        $message = config('transactions.fill_error_text.error_unknown');
                        Log::error('[Payment ERROR]: ' . $e->getMessage() . $e->getTraceAsString());
                }
            }

            \Log::error('[Payment fill ERROR]: ' . $message . $e->getMessage() . $e->getTraceAsString());

            DB::rollBack();
            if ($to_user != null) {
                $to_user->notify(new SendTransactionStatusFillRejected($message));
            }

            throw $e;

        } catch (\Throwable $e) {

            \Log::error('[Payment fill ERROR]: ' . $e->getMessage() . $e->getTraceAsString());

            $message = config('transactions.fill_error_text.error_unknown');

            DB::rollBack();
            if ($to_user != null) {
                $to_user->notify(new SendTransactionStatusFillRejected($message));
            }

            throw $e;

        }

        return $res;

    }

    public function checkBalanceFromProcessing($service_id, $number)
    {
        $service = $this->serviceRepository->getById($service_id);
        //dd($service_id);

        $payload = [
            'session_number' => (string) (new Carbon)->now()->timestamp,
            'amount' => '1',
            'processing_code' => (string) $service->processing_code,
            'account' => (string) $number,
        ];

        $processing = $this->queueTransport->send($payload, QueueHandlerEnum::PROCESSING_GET_INFO, false);
//        dd($processing);
        $params_string = $service->requestable_balance_params;

        $params = preg_split('/([{*\}])/i', $params_string, -1, PREG_SPLIT_NO_EMPTY | PREG_SPLIT_DELIM_CAPTURE);

        //dd($params);
        $comment = '';
        for ($i = 0; $i < count($params); $i++) {
            if ($params[$i] == '{') {
                if (isset($processing['data'][$params[$i + 1]])) {
                    $comment .= $processing['data'][$params[$i + 1]];
                }
            } elseif ($params[$i] == '}') {
                if (isset($params[$i + 1])) {
                    $comment .= $params[$i + 1];
                }
            } else {
                if ($i == 0) {
                    $comment .= $params[$i];
                }
            }
        }
        $data['comment'] = $comment;
        return $data;
    }

}
