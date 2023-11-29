<?php
/**
 * Created by PhpStorm.
 * User: F_Kosimov
 * Date: 18.07.2018
 * Time: 15:10
 */

namespace App\Repositories\Backend\Transaction;


use App\Exceptions\Backend\Web\ForbiddenException;
use App\Models\Transaction\Filters\Backend\TransactionFilter;
use App\Models\Transaction\Transaction;
use App\Services\Common\Helpers\Service;
use App\Services\Common\Helpers\TransactionQueuedStatus;
use App\Services\Common\Helpers\TransactionStatus;
use App\Services\Common\Helpers\TransactionStatusGroup;
use App\Services\Common\Helpers\TransactionSyncStatus as TransactionSyncStatusHelper;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;

class TransactionEloquentRepository implements TransactionRepositoryContract
{
    protected $transaction;

    public function __construct(Transaction $transaction)
    {
        $this->transaction = $transaction;
    }

    public function getForDataTable()
    {
    }

    public function all($data = [], $columns = ['*'])
    {
        $transaction = $this->transaction->with('service', 'service.gateway', 'transaction_type', 'user', 'transaction_status_detail', 'transaction_status', 'from_account_without_g_scopes.user', 'from_account_without_g_scopes.user.attestation', 'from_account_without_g_scopes.account_type.account_category_type', 'from_account_without_g_scopes.account_type.gateway', 'to_account_without_g_scopes.user', 'to_account_without_g_scopes.user.attestation', 'to_account_without_g_scopes.account_type.account_category_type', 'to_account_without_g_scopes.account_type.gateway', 'transaction_sync_status', 'merchant_item')->select($columns)->filterBy(new TransactionFilter($data))->get($columns);
        return $transaction;
    }

    public function allByStartDateAndEndDate($start_date, $end_date, $columns = ['*'])
    {
        /*$transaction = $this->transaction->with('service', 'service.gateway', 'transaction_type', 'user', 'transaction_status_detail', 'transaction_status', 'from_account_without_g_scopes.user', 'from_account_without_g_scopes.account_type.gateway', 'to_account_without_g_scopes.user', 'to_account_without_g_scopes.account_type.account_category_type', 'to_account_without_g_scopes.account_type.gateway', 'transaction_sync_status', 'merchant_item')
        ->with(['from_account_without_g_scopes.account_type.account_category_type' => function ($query) {
            $query->where(function($query2) {
                $query2->where('from_account_without_g_scopes.account_type.account_category_type.id', '!=', 'a5eb8080-e525-4a9e-9408-21e73bcc3f0f')
                    ->where('transactions.service_id', '==', Service::EWALLET_ESKHATA);
            })
            ->orWhere('transactions.service_id', '!=', Service::EWALLET_ESKHATA);
        }])
        ->where('created_at', '>=', $start_date)
        ->where('created_at', '<=', $end_date . " 23:59:59")
        
        ->where('service_id', '!=', Service::FILL_EWALLET_ESKHATA)
        ->where('service_id', '!=', Service::FILL_SBERBANK)
        ->select($columns)
        ->get($columns);

        ->join('account_types', function ($join) {
            $join->on('account_types.id', '=', 'accounts.account_type_id')
                 ->where(function ($query) {
                    $query->where(function ($query2) {
                        $query2->where('account_types.account_category_type_id', '!=', 'a5eb8080-e525-4a9e-9408-21e73bcc3f0f')
                              ->where('transactions.service_id', '=', '96e8b785-b1b9-11e8-904b-b06ebfbfa715');
                    })->orWhere('transactions.service_id', "!=", '96e8b785-b1b9-11e8-904b-b06ebfbfa715');
                });
        })
        
        
        */

        $transaction = $this->transaction->with('service', 'service.gateway', 'transaction_type', 'user', 'transaction_status_detail', 'transaction_status', 'from_account_without_g_scopes.user', 'from_account_without_g_scopes.account_type.gateway', 'to_account_without_g_scopes.user', 'to_account_without_g_scopes.account_type.account_category_type', 'to_account_without_g_scopes.account_type.gateway', 'transaction_sync_status', 'merchant_item')
            ->join('accounts', 'transactions.from_account_id', '=', 'accounts.id')
            ->join('account_types', 'account_types.id', '=', 'accounts.account_type_id')
            ->where('transactions.created_at', '>=', $start_date)
            ->where('transactions.created_at', '<=', $end_date . " 23:59:59")
            ->where('transactions.service_id', '!=', Service::FILL_EWALLET_ESKHATA)
            ->where('transactions.service_id', '!=', Service::FILL_SBERBANK)
            ->where(function ($query) {
                $query->where(function ($query2) {
                    $query2->where('account_types.account_category_type_id', '!=', 'a5eb8080-e525-4a9e-9408-21e73bcc3f0f')
                        ->where('transactions.service_id', '=', '96e8b785-b1b9-11e8-904b-b06ebfbfa715');
                })->orWhere('transactions.service_id', "!=", '96e8b785-b1b9-11e8-904b-b06ebfbfa715');
            })
            ->withoutGlobalScopes()
            ->select([
                'transactions.*'
            ])
            ->get($columns);


        return $transaction;
    }

    public function allForReport($columns = ['*'], $start_date = null, $end_date = null)
    {

        $transaction = $this->transaction
            ->with('service', 'service.gateway', 'transaction_type', 'user', 'transaction_status_detail', 'transaction_status', 'from_account_without_g_scopes.user',
                'from_account_without_g_scopes.account_type.gateway', 'to_account_without_g_scopes.user', 'to_account_without_g_scopes.account_type.account_category_type',
                'to_account_without_g_scopes.account_type.gateway', 'transaction_sync_status', 'merchant_item', 'children', 'children.service', 'children.from_account_without_g_scopes',
                'children.to_account_without_g_scopes', 'children.transaction_status', 'children.merchant_item', 'children.from_account_without_g_scopes.account_type.gateway',
                'children.to_account_without_g_scopes.account_type.gateway')
            ->where('transactions.service_id', '=', Service::MERCHANT)
            ->where('transactions.transaction_status_id', '=', TransactionStatus::COMPLETED);

        if (isset($start_date)) {
            $transaction->where('transactions.created_at', '>=', $start_date);
        }

        if (isset($end_date)) {
            $transaction->where('transactions.created_at', '<=', $end_date);
        }
        $transaction->withoutGlobalScopes()
            ->select()
            ->get($columns);

        return $transaction;
    }

    public function allNotSynced($columns = ['*'])
    {
        $transaction = $this->transaction
            ->where('transaction_status_id', TransactionStatus::COMPLETED)
            ->where('transaction_sync_status_id', TransactionSyncStatusHelper::NEED_TO_SYNC)
            /*->orWhere(function($query) {
                $query->where(function($query2) {
                    $query2->where('transaction_sync_status_id', TransactionSyncStatusHelper::IN_PROCESS_QUEUE)
                        ->orWhere('transaction_sync_status_id', TransactionSyncStatusHelper::IN_PROCESS_BUS);
                })
                ->where('updated_at', '<', Carbon::now()->subMinutes(90)->toDateTimeString());
            })*/
            ->get($columns);

        return $transaction;
    }

    public function paginate($data = [], $perPage = 60, $columns = ['*'])
    {
        return $this->transaction
            ->select($columns)
            ->filterBy(new TransactionFilter($data))
            ->where('parent_id', '=', null)
            ->with(
                'service',
                'transaction_type',
                'user',
                'transaction_status_detail',
                'transaction_status',
                'from_account_without_g_scopes.user',
                'from_account_without_g_scopes.account_type.gateway',
                'from_account_without_g_scopes.account_type.account_category_type',
                'to_account_without_g_scopes.user',
                'to_account_without_g_scopes.account_type.gateway',
                'to_account_without_g_scopes.account_type.account_category_type',
                'transaction_status.transaction_status_group',
                'transaction_sync_status',
                'service.gateway',
                'merchant_item'
            )
            ->orderBy('created_at', 'desc')
            ->simplePaginate($perPage);
    }

    public function paginateForMerchantQrTransaction($data = [], $perPage = 60, $columns = ['*'])
    {
        return $this->transaction
            ->select($columns)
            ->filterBy(new TransactionFilter($data))
            ->where('service_id', '=', \App\Services\Common\Helpers\Service::MERCHANT)
            ->whereRaw('merchant_item_id IS NOT NULL')
            ->whereHas("merchant_item.merchant", function ($query) {
                return $query->userBranch();
            })
            ->with(
                'service',
                'merchant_item',
                'merchant_item.merchant',
                'merchant_item.merchant.branch',
                'merchant_item.merchant.city',
                'cashback_form_merchant',
                'from_account_without_g_scopes',
                'from_account_without_g_scopes.account_type',
                'user',
                'user.attestation',
                'transaction_status'
            )
            ->orderBy('created_at', 'desc')
            ->simplePaginate($perPage);
    }

    public function paginateForBeetweenEwalletEskhataTransaction($data = [], $perPage = 60, $columns = ['*'])
    {
        return $this->transaction
            ->select($columns)
            ->with(
                'from_account_without_g_scopes',
                'to_account_without_g_scopes',
                'from_account_without_g_scopes.user_without_g_scopes',
                'to_account_without_g_scopes.user_without_g_scopes',
                'from_account_without_g_scopes.user_without_g_scopes.region',
                'to_account_without_g_scopes.user_without_g_scopes.region',
                'from_account_without_g_scopes.user_without_g_scopes.area',
                'to_account_without_g_scopes.user_without_g_scopes.area',
                'from_account_without_g_scopes.user_without_g_scopes.country',
                'to_account_without_g_scopes.user_without_g_scopes.country'
            )->whereHas("from_account_without_g_scopes", function ($query){
                $query->withoutGlobalScopes()->where("account_type_id", \App\Services\Common\Helpers\AccountTypes::EWALLET_ESKHATA);
            })
            ->where('service_id', \App\Services\Common\Helpers\Service::EWALLET_ESKHATA)
            ->filterBy(new TransactionFilter($data))
            ->orderBy('created_at', 'desc')
            ->simplePaginate($perPage);
    }

    public function getByParentId($parent_id, $columns = ['*'])
    {
        return $this->transaction
            ->select($columns)
            ->with(
                'service',
                'transaction_type',
                'user',
                'transaction_status_detail',
                'transaction_status',
                'from_account_without_g_scopes.user',
                'from_account_without_g_scopes.account_type.gateway',
                'from_account_without_g_scopes.account_type.account_category_type',
                'to_account_without_g_scopes.user',
                'to_account_without_g_scopes.account_type.gateway',
                'to_account_without_g_scopes.account_type.account_category_type',
                'transaction_status.transaction_status_group',
                'transaction_sync_status',
                'service.gateway'
            )
            ->where('parent_id', $parent_id)
            ->orWhere('id', $parent_id)
            ->orderBy('created_at', 'asc')
            ->get();
    }

    public function listsAll()
    {

    }

    public function create(array $data)
    {
        return $this->transaction->create($data);
    }

    public function findById($id, $columns = ['*'])
    {
        return $this->transaction->with('service', 'transaction_type', 'user', 'transaction_status_detail', 'transaction_status', 'from_account_without_g_scopes.user', 'to_account_without_g_scopes.user')->select($columns)->findOrFail($id);
    }

    public function resend($id)
    {
        $transaction = $this->transaction->findOrFail($id);
        $transaction->is_queued = 0;
        $transaction->save();
        return $transaction;
    }

    public function continue_process($id)
    {
        $transaction = $this->transaction->findOrFail($id);
        $transaction->is_queued = -1;
        $transaction->save();
        return $transaction;
    }

    public function editStatus($id, $transaction_status_id, $comment)
    {
        $transaction = $this->transaction->findOrFail($id);
        $transaction->comment = $comment;
        $transaction->transaction_status_id = $transaction_status_id;
        $transaction->save();
        return $transaction;
    }

    public function findBySessionIn($session_in, $columns = ['*'])
    {
        return $this->transaction->select($columns)->where('session_in', $session_in)->first();
    }

    public function update(array $data, $id)
    {
        //dd($data);
        $transaction = $this->transaction->findOrFail($id);
        $transaction->setOldAttributes($transaction->getAttributes());
        $transaction->update($data);
        return $transaction;
    }

    public function lastLoginUpdate($id)
    {
    }

    public function destroy($id)
    {
        $transaction = $this->transaction->findOrFail($id);
        $transaction->setOldAttributes($transaction->getAttributes());
        $transaction->delete();
        return $transaction;
    }

    public function changeStatus(array $data)
    {

    }

    public function getAllByNotSendToQueue()
    {
        return $this->transaction
            ->whereHas('from_account', function ($q) {
                $q->withoutGlobalScopes();
            })
            ->
            with('from_account_without_g_scopes.user', 'service')
            ->whereIn('is_queued', [TransactionQueuedStatus::NOT_SEND, TransactionQueuedStatus::ERROR_SEND])
            ->whereIn('transaction_status_id', [TransactionStatus::new, TransactionStatus::PAY_IN_PROCESS, TransactionStatus::PAY_ACCEPTED])
            ->whereNull('process_payload_json')
            ->get();
    }

    public function getAllByWillContinueProcess()
    {
        return $this->transaction
            ->whereHas('from_account', function ($q) {
                $q->withoutGlobalScopes();
            })
            ->
            with('from_account_without_g_scopes.user', 'service')
            ->where('is_queued', TransactionQueuedStatus::MUST_CONTINUE)
            ->whereNotIn('transaction_status_id', [TransactionStatus::NOT_VERIFIED, TransactionStatus::COMPLETED, TransactionStatus::REJECTED, TransactionStatus::UNKNOWN])
            ->get();
    }

    public function changeTransactionSyncStatus($transaction_sync_status_id, $id)
    {
        $transaction = $this->transaction->findOrFail($id);
        $transaction->transaction_sync_status_id = $transaction_sync_status_id;
        $transaction->save();
        return $transaction;
    }

    public function countNotVerifiedByDaysAgo($count_day)
    {
        return Cache::remember('countNotVerified', config('app_settings.cache_minutes'), function () use ($count_day) {
            return $this->transaction
                ->where('transaction_status_id', TransactionStatus::NOT_VERIFIED)
                ->where('created_at', '>=', Carbon::now()->subDays($count_day))
                ->count();
        });
    }

    public function countRejectedByDaysAgo($count_day)
    {
        return Cache::remember('countRejected', config('app_settings.cache_minutes'), function () use ($count_day) {
            return $this->transaction
                ->where('transaction_status_id', TransactionStatus::REJECTED)
                ->where('created_at', '>=', Carbon::now()->subDays($count_day))
                ->count();
        });
    }

    public function countOnQueueByDaysAgo($count_day)
    {
        return Cache::remember('countOnQueue', config('app_settings.cache_minutes'), function () use ($count_day) {
            return $this->transaction
                ->where('transaction_sync_status_id', TransactionSyncStatusHelper::IN_PROCESS_QUEUE)
                ->where('created_at', '>=', Carbon::now()->subDays($count_day))
                ->count();
        });
    }

    public function countErrorQueueByDaysAgo($count_day)
    {
        return Cache::remember('countErrorQueue', config('app_settings.cache_minutes'), function () use ($count_day) {
            return $this->transaction
                ->where('transaction_sync_status_id', TransactionSyncStatusHelper::ERROR_QUEUE)
                ->where('created_at', '>=', Carbon::now()->subDays($count_day))
                ->count();
        });
    }

    public function countErrorBusByDaysAgo($count_day)
    {
        return Cache::remember(' countErrorBus', config('app_settings.cache_minutes'), function () use ($count_day) {
            return $this->transaction
                ->where('transaction_sync_status_id', TransactionSyncStatusHelper::ERROR_BUS)
                ->where('created_at', '>=', Carbon::now()->subDays($count_day))
                ->count();
        });
    }

    public function countGroupInProcessByDaysAgo($count_day)
    {
        return Cache::remember('countGroupInProcess', config('app_settings.cache_minutes'), function () use ($count_day) {
            return $this->transaction
                ->whereHas('transaction_status', function ($q) {
                    $q->where('transaction_status_group_id', TransactionStatusGroup::IN_PROCESSING);
                })
                ->where('created_at', '>=', Carbon::now()->subDays($count_day))
                ->count();
        });
    }

    public function getByIdNotSyncedAndLockForUpdate($id)
    {
        return $this->transaction
            ->with('service', 'service.gateway', 'transaction_type', 'user', 'transaction_status_detail', 'transaction_status', 'from_account_without_g_scopes.user', 'from_account_without_g_scopes.user.attestation', 'from_account_without_g_scopes.account_type.account_category_type', 'from_account_without_g_scopes.account_type.gateway', 'to_account_without_g_scopes.user', 'to_account_without_g_scopes.user.attestation', 'to_account_without_g_scopes.account_type.account_category_type', 'to_account_without_g_scopes.account_type.gateway', 'transaction_sync_status', 'merchant_item')
            ->where('id', $id)
            ->where('transaction_status_id', TransactionStatus::COMPLETED)
            ->where('transaction_sync_status_id', TransactionSyncStatusHelper::NEED_TO_SYNC)
            ->withoutGlobalScopes()->lockForUpdate()->first();
    }

    public function findLastWithdrawByMerchantId($merchant_account_id)
    {
        return $this->transaction
            ->with('service')
            ->where('from_account_id', $merchant_account_id)
            ->where('service_id', Service::BANK_TO_ACCOUNT_YUR)
            ->where('transaction_status_id', "!=", TransactionStatus::REJECTED)
            ->where('created_at', '<=', Carbon::now()->format('Y-m-d 23:59:59'))//TODO Carbon::yesterday()
            ->where('created_at', '>=', config('merchant.x_start_date'))
            ->orderBy('session_number', 'desc')
            ->withoutGlobalScopes()
            ->first();
    }

    public function findProblemTransactionsWithUnionSummByMerchantIdAndDate($merchant_transit_account_id, $merchant_last_withdraw_date)
    {
        return $this->transaction
            ->where('to_account_id', $merchant_transit_account_id)
            ->where('service_id', Service::MERCHANT)
            ->where('is_cashback_process_completed', "!=", 2)
            ->whereNotIn('transaction_status_id', [TransactionStatus::REJECTED, TransactionStatus::NOT_VERIFIED])
            ->where('created_at', '>=', $merchant_last_withdraw_date)
            ->where('created_at', '<', Carbon::now()->format('Y-m-d'))//TODO Carbon::yesterday()
            ->orderBy('session_number', 'desc')
            ->withoutGlobalScopes()
            ->get();
    }

    public function getSummForWithdrawToMerchantByMerchantIdAndDate($merchant_account_id, $merchant_last_withdraw_date)
    {
        return $this->transaction
            ->where('to_account_id', $merchant_account_id)
            ->where('service_id', Service::TRANSFER_FROM_TRANSIT_MERCHANT_TO_ACCOUNT_MERCHANT)
            ->where('created_at', '>=', $merchant_last_withdraw_date)
            ->where('created_at', '<', Carbon::now()->format('Y-m-d'))//TODO Carbon::yesterday()
            ->orderBy('session_number', 'desc')
            ->withoutGlobalScopes()
            ->sum('amount');
    }

}
