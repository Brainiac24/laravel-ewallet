<?php
/**
 * Created by PhpStorm.
 * User: Nabijon
 * Date: 26.08.2021
 * Time: 15:32
 */

namespace App\Repositories\Backend\Transaction\TransactionHistoryDwh;


use App\Models\Transaction\TransactionHistoryDwh\TransactionHistoryDwh;

class TransactionHistoryDwhEloquentRepository implements TransactionHistoryDwhRepositoryContract
{

    public function create(array $transactionHistory)
    {
        $transactionHistoryDwh = new TransactionHistoryDwh();
        $transactionHistoryDwh->fill($transactionHistory);
        $transactionHistoryDwh->save();

        return $transactionHistoryDwh;
    }

    public function recordsBeforeDate($date)
    {
        $limit = config('app_settings.transaction_history_select_max_rows_for_dwh', null);

        if($limit){
            return TransactionHistoryDwh::where('created_at', '<', $date)->limit($limit)->get();
        }

        return [];

    }
}