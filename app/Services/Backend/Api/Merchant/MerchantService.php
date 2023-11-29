<?php

namespace App\Services\Backend\Api\Merchant;

use App\Exceptions\Frontend\Api\LogicException;
use App\Models\JobLog\JobLog;
use App\Repositories\Backend\Account\AccountRepositoryContract;
use App\Repositories\Backend\Merchant\MerchantRepositoryContract;
use App\Repositories\Backend\Transaction\TransactionRepositoryContract;
use App\Services\Common\Gateway\AspTransport\AspTransport;
use App\Services\Common\Helpers\Logger\Logger;
use App\Services\Common\Helpers\Merchant;
use App\Services\Common\Helpers\TransactionStatus;
use Carbon\Carbon;
use GuzzleHttp\Exception\ConnectException;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;

class MerchantService
{
    protected $transactionRepository;
    protected $accountRepository;
    protected $merchantRepository;
    protected $aspTransport;
    protected $logger;
    protected $lockedMerchant;

    const SEND_MERCHANT_WITHDRAW_MONEY_TO_ASP = 36;

    public function __construct(TransactionRepositoryContract $transactionRepository, AccountRepositoryContract $accountRepository, MerchantRepositoryContract $merchantRepository, AspTransport $aspTransport)
    {
        $this->transactionRepository = $transactionRepository;
        $this->accountRepository = $accountRepository;
        $this->merchantRepository = $merchantRepository;
        $this->aspTransport = $aspTransport;
        $this->logger = new Logger('merchant/merchant_service', 'WITHDRAW_TO_MERCHANT_ASP_CALLBACK');
    }

    public function withdrawMoneyToMerchantAccount($guid)
    {

        $succeedWithdrawMerchants = [];
        $failedWithdrawMerchants = [];

        $log = '---------- НАЧАЛО: ' . Carbon::now()->format('Y-m-d H:i:s') . " ----------";
        $this->logger->info($log);

        $merchantList = $this->merchantRepository->getAllWhereAccountBalanceGreaterThanZero();

        $log = "Количество мерчантов: " . count($merchantList) . "---- ДАТА: " . Carbon::now()->format('Y-m-d H:i:s');
        $this->logger->info($log . " ---- СЕССИЯ: " . $guid);

        foreach ($merchantList as $merchant) {

            DB::beginTransaction();

            $commited = false;
            $job = null;
            $lockedMerchant = null;
            $lockedMerchantOldWithdrawDatetime = null;
            try {
                $log = $merchant->name . "---- ID: " . $merchant->id;
                $this->logger->info($log . "---- СЕССИЯ: " . $guid);

                $problemTransactions = null;

                if ($merchant->account_id == null) {
                    $log = trans('merchant.errors.merchant_account_is_null');
                    $this->logger->info($log . " ---- СЕССИЯ: " . $guid);

                    throw new LogicException(trans('merchant.errors.merchant_account_is_null'));
                }

                if (($merchant->account->balance - $merchant->account->blocked_balance) <= 0) {
                    $succeedWithdrawMerchants[] = [
                        'status' => Merchant::NOT_NEED_TO_WITHDRAW,
                        'desc' => config('app_settings.NOT_NEED_TO_WITHDRAW_TEXT'),
                        'merchant' => $merchant,
                    ];

                    $log = "Мерчант не имеет на балансе средств для вывода средств";
                    $this->logger->info($log . " ---- СЕССИЯ: " . $guid);

                } else {
                    if ($merchant->last_withdraw_at != null && $merchant->last_withdraw_at > Carbon::now()->subMinutes(config('app_settings.merchant_last_withdraw_interval'))->format('Y-m-d H:i:s')) {
                        $failedWithdrawMerchants[] = [
                            'status' => Merchant::HAS_WAIT_FOR_COMPLETE_WITHDRAW,
                            'desc' => config('app_settings.HAS_WAIT_FOR_COMPLETE_WITHDRAW_TEXT'),
                            'merchant' => $merchant,
                        ];

                        $log = "Предыдущий запрос по выводу средств в процессе обработки: " . $merchant->last_withdraw_at;
                        $this->logger->info($log . " ---- СЕССИЯ: " . $guid);
                    } else {
                        $lockedMerchant = $this->merchantRepository->findMerchantByIdAndLockForUpdate($merchant->id);

                        $merchantLastWithdraw = $this->transactionRepository->findLastWithdrawByMerchantId($lockedMerchant->account_id);

                        if ($merchantLastWithdraw != null && $merchantLastWithdraw->transaction_status_id != TransactionStatus::COMPLETED) {
                            $problemTransactions = [$merchantLastWithdraw];

                            foreach ($problemTransactions as $transaction) {
                                $failedWithdrawMerchants[] = [
                                    'status' => Merchant::HAS_FAILED_WITHDRAW,
                                    'desc' => config('app_settings.HAS_FAILED_WITHDRAW_TEXT'),
                                    'transaction' => $transaction,
                                    'merchant' => $merchant,
                                ];
                            }

                            $log = "Предыдущий запрос по выводу средств не был завершён успешно: " . $merchantLastWithdraw->id;
                            $this->logger->info($log . " ---- СЕССИЯ: " . $guid);
                        } else {
                            if ($merchantLastWithdraw == null) {
                                $merchant_last_withdraw_date = config('merchant.x_start_date');
                            } else {
                                $merchant_last_withdraw_date = Carbon::parse($merchantLastWithdraw->created_at)->format('Y-m-d 00:00:00');
                            }


                            if (strtotime($merchant_last_withdraw_date) >= strtotime(Carbon::now()->format('Y-m-d 00:00:00'))) {
                                $log = trans('merchant.errors.start_end_date_is_wrong') . ": " . $merchant_last_withdraw_date . " >= " . Carbon::now()->format('Y-m-d');
                                $this->logger->info($log . " ---- СЕССИЯ: " . $guid);

                                $succeedWithdrawMerchants[] = [
                                    'status' => Merchant::NOT_NEED_TO_WITHDRAW,
                                    'desc' => config('app_settings.NOT_NEED_TO_WITHDRAW_TEXT'),
                                    'merchant' => $merchant,
                                ];
                            }

                            $problemTransactions = $this->transactionRepository->findProblemTransactionsWithUnionSummByMerchantIdAndDate($merchant->transit_account_id, $merchant_last_withdraw_date);

                            foreach ($problemTransactions as $transaction) {
                                $failedWithdrawMerchants[] = [
                                    'status' => Merchant::HAS_FAILED_TRANSACTIONS,
                                    'desc' => config('app_settings.HAS_FAILED_TRANSACTIONS_TEXT'),
                                    'transaction' => $transaction,
                                    'merchant' => $merchant,
                                ];
                            }
                        }

                        if (count($problemTransactions) == 0) {
                            $amount = $this->transactionRepository->getSummForWithdrawToMerchantByMerchantIdAndDate($merchant->account_id, $merchant_last_withdraw_date);
                            
                            if ($amount > 0) {
                                $nowDate = Carbon::now()->format('Y-m-d H:i:s');
                                $job = new JobLog();
                                $job->id = (string) Uuid::uuid4();
                                $job->params_json = ['merchant_id' => $merchant->id, 'merchant_account_id' => $merchant->account_id, 'amount' => $amount, "withdraw_start_date" => $merchant_last_withdraw_date, "withdraw_end_date" => $nowDate];
                                $job->type = self::SEND_MERCHANT_WITHDRAW_MONEY_TO_ASP;
                                $job->allowed_try_count = 0;
                                $job->created_by_user_id = config('app_settings.system_user_id');
                                $job->parent_id = '00000000-0000-0000-0000-000000000000';

                                $job->save();

                                $lockedMerchantOldWithdrawDatetime = $lockedMerchant->last_withdraw_at;
                                $lockedMerchant->last_withdraw_at = $nowDate;

                                $lockedMerchant->save();

                                DB::commit();
                                $commited = true;

                                $res = null;
                                $res = $this->aspTransport->sendRequest([
                                    'session_id' => $job->id,
                                ]);

                                $log = "Код журнала задач: " . $job->id;
                                $this->logger->info($log . " ---- СЕССИЯ: " . $guid);

                                if ($res == null) {
                                    $log = trans('merchant.errors.response_is_null');
                                    $this->logger->info($log . " ---- СЕССИЯ: " . $guid);
                                    throw new LogicException(trans('merchant.errors.response_is_null'));
                                }

                                $log = "Ответ asp_callback: " . $res;
                                $this->logger->info($log . " ---- СЕССИЯ: " . $guid);

                                $resArr = json_decode($res, true);

                                if ($resArr['success'] == true) {
                                    $succeedWithdrawMerchants[] = [
                                        'status' => Merchant::HAS_SUCCESS_WITHDRAW,
                                        'desc' => config('app_settings.HAS_SUCCESS_WITHDRAW_TEXT'),
                                        'merchant' => $merchant,
                                        'amount' => $amount
                                    ];
                                    $log = "Успешно: --- merchant_id: " . $merchant->id;
                                    $this->logger->info($log . " ---- СЕССИЯ: " . $guid);
                                } else {
                                    $failedWithdrawMerchants[] = [
                                        'status' => Merchant::HAS_FAILED_CREATE_WITHDRAW,
                                        'desc' => config('app_settings.HAS_FAILED_CREATE_WITHDRAW_TEXT'),
                                        'merchant' => $merchant,
                                    ];
                                    if ($lockedMerchant != null) {
                                        $lockedMerchant->last_withdraw_at = $lockedMerchantOldWithdrawDatetime;
                                        $lockedMerchant->save();
                                    }

                                    $log = "Ошибка: Ответ из ASP CALLBACK был получен false --- " . $res;
                                    $this->logger->info($log . " ---- СЕССИЯ: " . $guid);
                                }
                            } else {
                                $succeedWithdrawMerchants[] = [
                                    'status' => Merchant::NOT_NEED_TO_WITHDRAW,
                                    'desc' => config('app_settings.NOT_NEED_TO_WITHDRAW_TEXT'),
                                    'merchant' => $merchant,
                                ];
                                $log = "Мерчант не имеет транзакций для вывода средств по выбранному промежуток времению. Последний вывод был произведён " . $merchant_last_withdraw_date;
                                $this->logger->info($log . " ---- СЕССИЯ: " . $guid);
                            }
                        }
                    }
                }
                if (!$commited) {
                    DB::commit();
                }
            } catch (ConnectException $conEx) {

                $failedWithdrawMerchants[] = [
                    'status' => Merchant::HAS_FAILED_CREATE_WITHDRAW,
                    'desc' => config('app_settings.HAS_FAILED_CREATE_WITHDRAW_TEXT'),
                    'merchant' => $merchant,
                ];

                $log = "Ошибка: ConnectException - " . $conEx->getMessage() . $conEx->getTraceAsString();
                $this->logger->info($log . " ---- СЕССИЯ: " . $guid);

                try {
                    $lockedMerchantOldWithdrawDatetime = $lockedMerchant->last_withdraw_at;
                    $lockedMerchant->last_withdraw_at = Carbon::now()->format('Y-m-d H:i:s');
                    $lockedMerchant->save();
                } catch (\Throwable $th) {
                }

                if (!$commited) {
                    DB::commit();
                }
            } catch (\Throwable $e) {

                $failedWithdrawMerchants[] = [
                    'status' => Merchant::HAS_FAILED_CREATE_WITHDRAW,
                    'desc' => config('app_settings.HAS_FAILED_CREATE_WITHDRAW_TEXT'),
                    'merchant' => $merchant,
                ];

                $log = "Ошибка: " . $e->getMessage() . $e->getTraceAsString();
                $this->logger->info($log . " ---- СЕССИЯ: " . $guid);

                try {
                    $lockedMerchantOldWithdrawDatetime = $lockedMerchant->last_withdraw_at;
                    $lockedMerchant->last_withdraw_at = Carbon::now()->format('Y-m-d H:i:s');
                    $lockedMerchant->save();
                } catch (\Throwable $th) {
                }

                if (!$commited) {
                    DB::commit();
                }
            }

        }

        $log = 'Количество успешных выводов средств мерчантов: ' . count($succeedWithdrawMerchants);
        $log2 = 'Количество не успешных транзакций мерчантов: ' . count($failedWithdrawMerchants);

        $this->logger->info($log . "---- СЕССИЯ: " . $guid);
        $this->logger->info($log2 . "---- СЕССИЯ: " . $guid);

        $log = '---------- КОНЕЦ: ' . Carbon::now()->format('Y-m-d H:i:s') . " ----------";

        $this->logger->info($log . " ---- СЕССИЯ: " . $guid);

        return [
            'succeed' => $succeedWithdrawMerchants,
            'failed' => $failedWithdrawMerchants,
        ];

    }
}
