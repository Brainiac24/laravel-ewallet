<?php

namespace App\Console\Commands\AbsTasks;

use Carbon\Carbon;
use Ramsey\Uuid\Uuid;
use App\Models\JobLog\JobLog;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use function GuzzleHttp\json_encode;
use App\Services\Common\Helpers\Logger\Logger;
use App\Exceptions\Frontend\Api\LogicException;
use App\Repositories\Backend\Merchant\MerchantItem\MerchantItemRepositoryContract;
use App\Services\Common\Gateway\Queue\QueueHandlerEnum;
use App\Services\Common\Gateway\Queue\QueueTransporterContract;
use App\Repositories\Backend\Merchant\MerchantRepositoryContract;
use App\Services\Backend\Api\Transaction\TransactionServiceContract;
use App\Repositories\Backend\Transaction\TransactionRepositoryContract;
use App\Services\Common\Helpers\TransactionSyncStatus as TransactionSyncStatusHelper;

class AbsCreateTransactionCommand extends Command
{

    const SEND_TRANSACTION_TO_ABS = 5;
    protected $signature = 'command:abs_account-to-account_sync_abs_command';

    protected $description = 'Command for send transactions to abs system for sync';

    protected $transactionRepository;
    protected $merchantItemRepository;
    protected $merchantRepository;
    protected $queueTransport;
    protected $logger;
    protected $queue_sent_count;
    protected $queue_error_count;
    protected $queue_error_text;
    protected $transactionService;

    public function __construct(TransactionRepositoryContract $transactionRepository, QueueTransporterContract $queueTransporter, MerchantItemRepositoryContract $merchantItemRepository, MerchantRepositoryContract $merchantRepository, TransactionServiceContract $transactionService)
    {
        parent::__construct();
        $this->transactionRepository = $transactionRepository;
        $this->queueTransport = $queueTransporter;
        $this->merchantItemRepository = $merchantItemRepository;
        $this->merchantRepository = $merchantRepository;
        $this->transactionService = $transactionService;
        $this->logger = new Logger('gateways/abs', 'ABS_TRANSPORT');
        $this->queue_sent_count = 0;
        $this->queue_error_count = 0;
    }

    public function handle()
    {
        //ini_set('max_execution_time', '10');
        //set_time_limit(10);

        $this->logger->info(' Started: ' . __CLASS__);

        $uuid = (string) Uuid::uuid4();


        $transactions = $this->transactionRepository->allNotSynced();
        $count = $transactions->count();
        echo "Количество синхронизируемых транзакций: {$count}\n ";
        $this->logger->info("Количество синхронизируемых транзакций: {$count} ---- " . $uuid);

        $session_id = null;
        $job = null;
        $to_account_text = '';
        $from_account_text = '';

        $merchant = null;
        foreach ($transactions as $transaction) {
            $item = null;
            DB::beginTransaction();

            try {
                $cont_cur_code = '';
                $session_id = (string) Uuid::uuid4();
                $delay = null;
                $delimiter_purpose = '';

                $item = $this->transactionRepository->getByIdNotSyncedAndLockForUpdate($transaction->id);

                $from_account = $item->from_account_without_g_scopes->account_type->gateway->credit_json[$item->from_account_without_g_scopes->currency->code];
                $to_account = '';

                if ($item != null) {
                    $operation_type = "TRANSACTION";
                    if ($item->service->code == 'CURRENCY_EXCHANGE_V2') {
                        $operation_type = "EXCHANGE";
                    }

                    if ($item->from_account_without_g_scopes->account_type->code == 'VIRTUAL_MERCHANT' && $item->to_account_without_g_scopes->account_type->code == 'VIRTUAL_COMMON_BONUS') {
                        $delay = Carbon::now()->addMinutes(config('app_settings.transaction_sync_delay_minutes'))->format('Y-m-d H:i:s');
                    } elseif ($item->from_account_without_g_scopes->account_type->code == 'VIRTUAL_EXPENSE' && $item->to_account_without_g_scopes->account_type->code == 'VIRTUAL_COMMON_BONUS') {
                        $delay = Carbon::now()->addMinutes(config('app_settings.transaction_sync_delay_minutes'))->format('Y-m-d H:i:s');
                    }

                    if ($item->from_account_without_g_scopes->account_type->code == 'EWALLET_ESKHATA') {
                        $from_account_text = $item->from_account_without_g_scopes->user->msisdn;
                    } elseif ($item->from_account_without_g_scopes->account_type->gateway->code == 'DEFAULT') {
                        $from_account_text = $item->from_account_without_g_scopes->params_json['acc_code'];
                        $from_account = $item->from_account_without_g_scopes->params_json['acc_code'];
                    } else {
                        $from_account_text = $item->from_account_without_g_scopes->number;
                    }

                    $cont_bank_id = '';
                    $comment = '';
                    $to_account_text = '';
                    $merchant_name_delimiter = '';
                    $merchant_item_name_delimiter = '';
                    $merchant_number_delimiter = '';
                    foreach ($item->params_json as $item2) {
                        if ($item2['key'] == 'cont_bank_id') {
                            $cont_bank_id = $item2['value']; //TODO if not Eskhata then use cont_bank_id
                        }
                        if ($item->service->code != 'EWALLET_ESKHATA') {
                            if ($item2['key'] == 'comment') {
                                $comment = $item2['value'];
                            }
                        }
                        if ($item2['key'] == 'to_account') {
                            if ($item->service->code == 'MERCHANT') {
                                $merchantItem = $this->merchantItemRepository->findByAccountIdWithoutGlobal($item->to_account_without_g_scopes->id);
                                if ($merchantItem == null) {
                                    $merchant = $this->merchantRepository->findByTransitAccountIdWithoutGlobal($item->to_account_without_g_scopes->id);
                                    $to_account_text = $merchant->name . " (" . $item->merchant_item->name . ") " ;
                                    
                                    $merchant_name_delimiter = $merchant->name;
                                    $merchant_item_name_delimiter = $item->merchant_item->name;
                                    $merchant_number_delimiter = $merchant->account_number;
                                }else{
                                    $to_account_text = $merchantItem->merchant->name . " (" . $merchantItem->name . ") " ;

                                    $merchant_name_delimiter = $merchantItem->merchant->name;
                                    $merchant_item_name_delimiter = $merchantItem->name;
                                    $merchant_number_delimiter = $merchantItem->merchant->account_number;
                                }

                                
                                
                            }else{
                                $to_account_text = $item2['value'];
                            } 
                        }
                        if ($item2['key'] == 'to_account_id') {
                            if ($item->service->code == 'EWALLET_ESKHATA') {
                                $to_account_text = $item->to_account_without_g_scopes->user->msisdn;
                            }else {
                                $to_account_text = $item->to_account_without_g_scopes->number;
                            }
                        }
                    }

                    if ($item->service->gateway->code == 'PS_ESKHATA') {
                        $gateway = $item->service->code_map;
                    } elseif ($item->service->gateway->code == 'DEPENDS_TO_ACCOUNT') {
                        if ($item->to_account_without_g_scopes->account_type->gateway->code == 'DEFAULT') {
                            $gateway = $item->to_account_without_g_scopes->params_json['acc_code'];
                        } else {
                            $cont_cur_code = $item->to_account_without_g_scopes->currency->code;
                            $gateway = $item->to_account_without_g_scopes->account_type->gateway->debet_json[$cont_cur_code];
                        }
                    } elseif ($item->service->gateway->code == 'MERCHANT') {
                        $cont_cur_code = $item->to_account_without_g_scopes->currency->code;
                        $gateway = $item->to_account_without_g_scopes->account_type->gateway->debet_json[$cont_cur_code];

                        if ($gateway == null) {
                            throw new LogicException(trans('accounts.errors.code_not_found'));
                        }
                    } elseif ($item->service->gateway->code == 'WITHDRAWAL_FUNDS_TO_LEGAL_ENTITY') {

                        $gateway = '';
                        $to_account = $to_account_text;
                        if ($to_account == null) {
                            throw new LogicException(trans('accounts.errors.code_not_found'));
                        }

                        //$to_account_text =  $merchant->name . ' (' . ($to_account ?? $gateway) . ')';
                    } else {
                        $gateway = $item->service->gateway->debet_json[$item->service->currency->code];
                    }

                    $purpose = config('app_settings.transaction_sync_abs_purpose_text');

                    $soniya = '';
                    $amount_all = $item->converted_amount;
                    if ($item->service->code == 'TRANSFER_SONIYA_V2') {
                        $soniya = ', код перевода ' . $item->process_payload_json['SoniyaTransferCode'] ?? '';
                        $amount_all = $item->converted_amount + $item->commission; // коммиссияя сониява худошон мезанад алохида проводка кади
                    }

                    $purpose = str_replace('{category}', (isset($item->service->categories[0]) ? $item->service->categories[0]->name : "Платежи и переводы"), $purpose);
                    $name = $item->from_account_without_g_scopes->params_json['name_holder_tj'] ?? $item->from_account_without_g_scopes->params_json['name_holder_en'] ?? (trim($item->from_account_without_g_scopes->user->first_name) . ' ' . trim($item->from_account_without_g_scopes->user->last_name) . ' ' . trim($item->from_account_without_g_scopes->user->middle_name));
                    $purpose = str_replace('{fio}', ($name . ' (' . $from_account_text . ')'), $purpose);
                    $purpose = str_replace('{service}', $item->service->name . ' - ' . $to_account_text, $purpose);
                    $purpose = str_replace('{amount}', round($item->amount_all, 2), $purpose);
                    $purpose = str_replace('{currency}', $item->service->currency->iso_name . $soniya, $purpose);
                    $purpose = str_replace('{date}', Carbon::parse($item->created_at)->format('d.m.Y'), $purpose);
                    $purpose = str_replace('{purpose}', $comment, $purpose);

                    //echo json_encode($item->from_account_without_g_scopes->account_type->gateway->credit_json) . "\n";
                    //echo json_encode($item->to_account_without_g_scopes->params_json);

                    $cont_user_id_from = $item->from_account_without_g_scopes->user_without_g_scopes->code_map ?? '0';
                    //ASP посылает user->code_map а не card_user->code_map при создании транзакции в ABS  поэтому условие ниже закомментировано
                   /* if (
                        (
                            $item->from_account_without_g_scopes->account_type->gateway->code == 'RUCARD' ||
                            $item->from_account_without_g_scopes->account_type->gateway->code == 'BPC_VISA' ||
                            $item->from_account_without_g_scopes->account_type->gateway->code == 'MTM' ||
                            $item->from_account_without_g_scopes->account_type->gateway->code == 'KORTI_MILLI'
                        ) &&
                        $item->from_account_without_g_scopes->params_json['is_own'] == false
                    ) {
                        $cont_user_id_from = $item->from_account_without_g_scopes->params_json['user_id'] ?? '0';
                    }*/

                    $cont_user_id_to = $item->to_account_without_g_scopes->user_without_g_scopes->code_map ?? '0';
                    //ASP посылает user->code_map а не card_user->code_map при создании транзакции в ABS  поэтому условие ниже закомментировано
                    /*if (
                        !empty($item->to_account_without_g_scopes) &&
                        (
                            $item->to_account_without_g_scopes->account_type->gateway->code == 'RUCARD' ||
                            $item->to_account_without_g_scopes->account_type->gateway->code == 'BPC_VISA' ||
                            $item->to_account_without_g_scopes->account_type->gateway->code == 'MTM' ||
                            $item->to_account_without_g_scopes->account_type->gateway->code == 'KORTI_MILLI'
                        ) &&
                        $item->to_account_without_g_scopes->params_json['is_own'] == false
                    ) {
                        $cont_user_id_to = $item->to_account_without_g_scopes->params_json['user_id'] ?? '1';
                    }*/

                    $delimiter_purpose = (isset($item->service->categories[0]) ? $item->service->categories[0]->name : "Платежи и переводы") . "#"
                        . $item->service->name . "#"
                        . $this->transactionService->extractAccountNumberValue($item) . "#"
                        . $this->transactionService->extractAccountNumberValueWithServiceConditions($item) . "#"
                        . $merchant_name_delimiter . "#"
                        . $merchant_item_name_delimiter . "#"
                        . $merchant_number_delimiter;

                    $payload = [
                        'session_id' => $session_id,
                        'gateway' => 'ABS',
                        //'user_id' => $item->from_account_without_g_scopes->user_without_g_scopes->code_map,
                        'user_id' => $cont_user_id_from,
                        'transaction_id' => $item->id,
                        'acc_number' => '',
                        'acc_code' => $from_account,
                        'pan' => $item->from_account_without_g_scopes->params_json['pan'] ?? '',
                        'doc_id' => '',
                        'doc_num' => $item->session_number,
                        'doc_datetime' => Carbon::parse($item->created_at)->format('Y-m-d'),
                        'type' => 'D',
                        'curr_code' => $item->from_account_without_g_scopes->currency->code,
                        'curr_rate' => $item->currency_rate_value,
                        'amount' => $item->amount_all,
                        'cont_amount' => $amount_all,
                        'cont_curr_code' => $cont_cur_code ?? $item->service->currency->code,
                        'cont_name' => $item->service->name,
                        'cont_acc' => $to_account,
                        'cont_acc_code' => $gateway,
                        'cont_pan' => $item->to_account_without_g_scopes->params_json['pan'] ?? '',
                        'cont_user_id' => $cont_user_id_to,
                        'cont_inn' => '',
                        'cont_bank_bic' => '',
                        'cont_bank_corr_acc' => '',
                        'cont_bank_name' => '',
                        'cont_bank_id' => '',
                        'purpose' => $purpose,
                        'delimiter_purpose' => $delimiter_purpose,
                        'status' => '1', //ХАРДКОД Статус должен браться из справочника
                        'operation_type' => $operation_type,
                    ];

                    if ($item->commission > 0 && $item->service->code != 'TRANSFER_SONIYA_V2') {
                        $payload['amount'] = $item->amount;
                        $payload += [
                            'commission_amount' => $item->commission,
                            'commission_acc_code' => 'comission_esh_online',
                            'commission_doc_num' => 'c_' . $item->session_number,
                            'commission_abs_doc_id' => $item->process_payload_json['CommissionAbsDocId'] ?? '',
                        ];
                    }

                    //$this->logger->info($item->created_at);

                    echo " ------ \n" . json_encode($payload) . " \n";

                    $this->logger->info($uuid . " ------ \n" . json_encode($payload) . " \n");
                    //dd($payload);

                    $job = new JobLog();
                    $job->id = $session_id;
                    $job->params_json = ['transaction_id' => $item->id];
                    $job->type = self::SEND_TRANSACTION_TO_ABS;
                    $job->allowed_try_count = 0;
                    $job->transaction_id = $item->id;
                    $job->created_by_user_id = config('app_settings.system_user_id');
                    $job->parent_id = '00000000-0000-0000-0000-000000000000';
                    $job->queue_request_log = json_encode($payload);

                    $job->save();

                    $must_send_v2 = true;
                    if ($item->service->code == 'TRANSFER_SONIYA_V2' || $item->service->code == 'CURRENCY_EXCHANGE_V2') {
                        $must_send_v2 = false;
                    }

                    $queue = $this->queueTransport->send($payload, ($must_send_v2 == true ? QueueHandlerEnum::ACCOUNT_TO_ACCOUNT_SYNC_V2 : QueueHandlerEnum::ACCOUNT_TO_ACCOUNT_SYNC), true, $delay);
                    $this->queue_error_text[] = $queue;
                    if (isset($queue['success']) && $queue['success'] === true) {
                        $item->transaction_sync_status_id = TransactionSyncStatusHelper::IN_PROCESS_QUEUE;
                        $this->queue_sent_count++;
                    } else {
                        $item->transaction_sync_status_id = TransactionSyncStatusHelper::ERROR_QUEUE;
                        $this->queue_error_count++;
                    }

                    $item->save();
                } else {
                    $this->queue_error_text[] = 'CANNOT getByIdNotSyncedAndLockForUpdate session_id: ' . $session_id . ' - payload: ' . (($job != null) ? json_encode($job->params_json) : null) . ' \n ';
                    $this->queue_error_count++;
                    $this->logger->error('CANNOT getByIdNotSyncedAndLockForUpdate', $this->queue_error_text);
                }
                DB::commit();
            } catch (\Exception $e) {
                $this->queue_error_text[] = $e->getMessage() . ' session_id: ' . $session_id . ' - payload: ' . (($job != null) ? json_encode($job->params_json) : null) . ' \n ' . $e->getTraceAsString();
                $this->queue_error_count++;
                $this->logger->error($e->getMessage(), $this->queue_error_text);
                if ($item != null) {
                    $item->transaction_sync_status_id = TransactionSyncStatusHelper::ERROR_QUEUE;
                    $item->save();
                }
                DB::commit();
            } catch (\Throwable $e) {
                $this->queue_error_text[] = $e->getMessage() . ' session_id: ' . $session_id . ' - payload: ' . (($job != null) ? json_encode($job->params_json) : null) . ' \n ' . $e->getTraceAsString();
                $this->queue_error_count++;
                $this->logger->error($e->getMessage(), $this->queue_error_text);
                if ($item != null) {
                    $item->transaction_sync_status_id = TransactionSyncStatusHelper::ERROR_QUEUE;
                    $item->save();
                }

                DB::commit();
            }
        }
        echo " ------ \nКоличество успешных отправок в очередь: {$this->queue_sent_count}\n";
        $this->logger->info("Количество успешных отправок в очередь: {$this->queue_sent_count} ---- " . $uuid);
        echo "Количество ошибочных отправок в очередь: {$this->queue_error_count}\n Статусы:" . \json_encode($this->queue_error_text) . "\n";
        $this->logger->info("Количество ошибочных отправок в очередь: {$this->queue_error_count}---- " . $uuid . "\n  Статусы:" . \json_encode($this->queue_error_text));
        echo ' Finished: ' . __CLASS__ . "\n";
        $this->logger->info(' Finished: ' . __CLASS__);
    }
}
