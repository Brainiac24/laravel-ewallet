<?php

namespace App\Listeners\Frontend\Transaction\TransactionHistory;

use App\Events\Frontend\Transaction\TransactionHistory\TransactionModifiedEvent;
use App\Models\Transaction\TransactionHistory\TransactionHistory;
use App\Repositories\Frontend\Transaction\TransactionHistory\TransactionHistoryRepositoryContract;

class TransactionModifiedListener
{
    protected $transactionHistoryRepository;

    public function __construct(TransactionHistoryRepositoryContract $transactionHistoryRepository)
    {
        $this->transactionHistoryRepository = $transactionHistoryRepository;
    }

    public function handle(TransactionModifiedEvent $event)
    {

        //dd($event);
        $tran = $event->entity;
        $transactionHistory = new TransactionHistory();
        $transactionHistory->transaction_id = $tran->id;
        $transactionHistory->from_account_id = $tran->from_account_id;
        $transactionHistory->to_account_id = $tran->to_account_id;
        $transactionHistory->service_id = $tran->service_id;
        $transactionHistory->amount = $tran->amount;
        $transactionHistory->commission = $tran->commission;
        $transactionHistory->params_json = $tran->params_json;
        $transactionHistory->session_number = $tran->session_number;
        $transactionHistory->transaction_type_id = $tran->transaction_type_id;
        $transactionHistory->finished_at = $tran->finished_at;
        $transactionHistory->next_try_at = $tran->next_try_at;
        $transactionHistory->created_by_user_id = $tran->created_by_user_id;
        $transactionHistory->transaction_status_id = $tran->transaction_status_id;
        $transactionHistory->transaction_status_detail_id = $tran->transaction_status_detail_id;
        $transactionHistory->try_count = $tran->try_count;
        $transactionHistory->flag = $tran->flag;
        $transactionHistory->comment = $tran->comment;
        $transactionHistory->currency_rate_value = $tran->currency_rate_value;
        $transactionHistory->currency_iso_name = $tran->currency_iso_name;
        $transactionHistory->account_balance = $tran->account_balance;
        $transactionHistory->sms_code = $tran->sms_code;
        $transactionHistory->sms_code_sent_at = $tran->sms_code_sent_at;
        $transactionHistory->sms_code_sent_count = $tran->sms_code_sent_count;
        $transactionHistory->sms_confirm_try_count = $tran->sms_confirm_try_count;
        $transactionHistory->sms_confirm_try_at = $tran->sms_confirm_try_at;
        $transactionHistory->add_to_favorite = $tran->add_to_favorite;
        $transactionHistory->is_queued = $tran->is_queued;
        $transactionHistory->session_in = $tran->session_in;
        $transactionHistory->request = $tran->request;
        $transactionHistory->response = $tran->response;
        $transactionHistory->created_at = $tran->created_at;
        $transactionHistory->updated_at = $tran->updated_at;

        $transactionHistory->save();

    }
}
