<?php
/**
 * Created by PhpStorm.
 * User: Nabijon
 * Date: 26.08.2021
 * Time: 15:46
 */

namespace App\Services\Backend\Web\TransactionHistory;


use App\Models\Transaction\TransactionHistory\TransactionHistory;
use App\Repositories\Backend\Transaction\TransactionHistory\TransactionHistoryRepositoryContract;
use App\Repositories\Backend\Transaction\TransactionHistoryDwh\TransactionHistoryDwhRepositoryContract;
use App\Services\Common\Helpers\DatabaseErrorCode;
use App\Services\Common\Helpers\Logger\DwhRulesLogger;
use Carbon\Carbon;
use Illuminate\Database\QueryException;

class TransactionHistoryService implements TransactionHistoryServiceContract
{

    protected $transactionHistoryRepository;
    protected $transactionHistoryDwhRepository;
    private $logger;

    public function __construct(TransactionHistoryRepositoryContract $transactionHistoryRepositoryContract, TransactionHistoryDwhRepositoryContract $dwhRepositoryContract)
    {
        $this->transactionHistoryRepository = $transactionHistoryRepositoryContract;
        $this->transactionHistoryDwhRepository = $dwhRepositoryContract;
        $this->logger = new DwhRulesLogger();

    }

    public function copyToDwhAndRemoveOutdated($lifetimeInDays)
    {
        $removedCount = 0;
        $date = Carbon::now()->subDays($lifetimeInDays);
        $transactionHistories = $this->transactionHistoryRepository->recordsBeforeDate($date);

        foreach ($transactionHistories as $history) {
            $arrayHistory = $this->arrayFill($history);
            $shouldRemove = false;

            try{
                $this->transactionHistoryDwhRepository->create($arrayHistory);
                $shouldRemove = true;

            }catch (QueryException $exception){
                $errorCode = $exception->errorInfo[1];
                if ($errorCode===DatabaseErrorCode::DUPLICATE_ENTRY_KEY){
                    $this->logger->warning('Duplicate entry key for transaction_history_dwh '.$history->id);
                    $shouldRemove = true;
                }else{
                    $this->logger->error($exception->getMessage());
                    $this->logger->error($exception->getTraceAsString());
                }
            }catch (\Exception $exception){
                $this->logger->error($exception->getMessage());
                $this->logger->error($exception->getTraceAsString());
                $shouldRemove = false;
            }

            if($shouldRemove){
                $history->delete();
                $removedCount++;
            }
        }
        $this->logger->info("Removed $removedCount  transaction_history which have $lifetimeInDays lifetime");

        return $removedCount;
    }

    private function arrayFill(TransactionHistory $history)
    {
        return [
            'id' => $history->id,
            'parent_id' => $history->parent_id,
            'transaction_id' => $history->transaction_id,
            'from_account_id' => $history->from_account_id,
            'to_account_id' => $history->to_account_id,
            'service_id' => $history->service_id,
            'amount' => $history->amount,
            'from_current_iso_name' => $history->from_current_iso_name,
            'commission' => $history->commission,
            'converted_amount' => $history->converted_amount,
            'to_currency_iso_name' => $history->to_currency_iso_name,
            'currency_rate_value' => $history->currency_rate_value,
            'params_json' => $history->params_json,
            'session_number' => $history->session_number,
            'transaction_type_id' => $history->transaction_type_id,
            'finished_at' => $history->finished_at,
            'next_try_at' => $history->next_try_at,
            'created_by_user_id' => $history->created_by_user_id,
            'transaction_status_id' => $history->transaction_status_id,
            'transaction_status_detail_id' => $history->transaction_status_detail_id,
            'order_id' => $history->order_id,
            'merchant_item_id' => $history->merchant_item_id,
            'try_count' => $history->try_count,
            'flag' => $history->flag,
            'comment' => $history->comment,
            'currency_iso_name' => $history->currency_iso_name,
            'account_balance' => $history->account_balance,
            'device_platform' => $history->device_platform,
            'cache_json' => $history->cache_json,
            'is_otp' => $history->is_otp,
            'confirmed_at' => $history->confirmed_at,
            'sms_code' => $history->sms_code,
            'sms_code_sent_at' => $history->sms_code_sent_at,
            'sms_code_sent_count' => $history->sms_code_sent_count,
            'sms_confirm_try_count' => $history->sms_confirm_try_count,
            'sms_confirm_try_at' => $history->sms_confirm_try_at,
            'add_to_favorite' => $history->add_to_favorite,
            'is_queued' => $history->is_queued,
            'is_cashback_process_completed' => $history->is_cashback_process_completed,
            'process_payload_json' => $history->process_payload_json,
            'user_service_limit_json' => $history->user_service_limit_json,
            'session_in' => $history->session_in,
            'request' => $history->request,
            'response' => $history->response,
            'created_at' => $history->created_at_as_string,
            'updated_at' => $history->updated_at_as_string,
            'transaction_sync_status_id' => $history->transaction_sync_status_id,
        ];
    }
}