<?php

namespace App\Repositories\Frontend\Transaction;

use App\Events\Frontend\Transaction\TransactionHistory\TransactionModifiedEvent;
use App\Models\Transaction\Filters\Frontend\TransactionFilter;
use App\Models\Transaction\Transaction;
use App\Services\Common\Helpers\TransactionStatus;
use Illuminate\Support\Facades\Auth;

class TransactionEloquentRepository implements TransactionRepositoryContract
{

    protected $transaction;

    public function __construct(Transaction $transaction)
    {
        $this->transaction = $transaction;
    }

    public function all($columns = ['*'], $perPage = 10)
    {
        //$tran =  $this->transaction->with(['from_account','to_account','service.categories', 'transaction_type', 'user', 'transaction_status', 'transaction_status_detail'])->get($columns);
        return $this->transaction
            ->select($columns)
            ->has('from_account')
            ->with(['from_account', 'to_account', 'service.categories', 'transaction_type', 'user', 'transaction_status', 'transaction_status_detail'])
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);
    }

    public function allNotVerified($data = [], $columns = ['*'], $perPage = 10)
    {
        //$tran =  $this->transaction->with(['from_account','to_account','service.categories', 'transaction_type', 'user', 'transaction_status', 'transaction_status_detail'])->get($columns);
        //ХАРДКОД - account [0];
        $account = (Auth::user()->load('accounts'))->accounts[0];
        //dd($account);
        return $this->transaction
            ->select($columns)
            ->with(['from_account_without_g_scopes.user', 'to_account_without_g_scopes.user', 'service.categories', 'transaction_type', 'user', 'transaction_status', 'transaction_status_detail'])
            ->filterBy(new TransactionFilter($data))
            ->where('transaction_status_id', '!=', TransactionStatus::NOT_VERIFIED)
            ->where(function ($query) use ($account) {
                $query->where('from_account_id', '=', $account->id)
                    ->orWhere('to_account_id', '=', $account->id);
            })
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);
    }

    public function create(array $data, $eventCode = null)
    {
        $transaction = $this->transaction->create($data);
        //event(new TransactionModifiedEvent($transaction));
        return $transaction;
    }

    public function getByIdForShow($id, $columns = ['*'])
    {
        //ХАРДКОД - account [0];
        //dd($id);
        $account = (Auth::user()->load('accounts'))->accounts[0];
        return $this->transaction->with(['service', 'user', 'transaction_type', 'transaction_status.transaction_status_group'])
            ->where(function ($query) use ($account) {
                $query->where('from_account_id', '=', $account->id)
                    ->orWhere('to_account_id', '=', $account->id);
            })
            ->where('id', $id)
            ->first();
    }

    public function getById($id, $columns = ['*'])
    {
        //ХАРДКОД - account [0];
        $account = (Auth::user()->load('accounts'))->accounts[0];
        return $this->transaction->with(['from_account', 'to_account_without_g_scopes', 'service', 'transaction_type', 'user', 'transaction_status', 'transaction_status_detail'])
            ->where(function ($query) use ($account) {
                $query->where('from_account_id', '=', $account->id)
                    ->orWhere('to_account_id', '=', $account->id);
            })
            ->where('id', $id)
            ->first();
    }

    public function getByIdWithoutGlobalScopes($id, $columns = ['*'])
    {
        return $this->transaction->with(['from_account_without_g_scopes', 'to_account_without_g_scopes', 'service', 'transaction_type', 'user.accountsWithoutGlobalScope', 'transaction_status', 'transaction_status_detail'])->where('id', $id)->first();
    }

    public function getByIdAndLockForUpdateWithoutGlobalScopes($id, $columns = ['*'])
    {
        return $this->transaction->with(['from_account_without_g_scopes', 'to_account_without_g_scopes', 'service', 'transaction_type', 'user.accountsWithoutGlobalScope', 'transaction_status', 'transaction_status_detail'])->where('id', $id)->lockForUpdate()->first();
    }
    
    public function findBySessionInWithoutGlobalScopes($session_in, $columns = ['*'])
    {
        return $this->transaction->select($columns)->where('session_in', $session_in)->withoutGlobalScopes()->first();
    }

}
