<?php
/**
 * Created by PhpStorm.
 * User: Nabijon
 * Date: 26.08.2021
 * Time: 15:32
 */

namespace App\Repositories\Backend\Transaction\TransactionHistoryDwh;


interface TransactionHistoryDwhRepositoryContract
{
    public function create(array $transactionHistory);

    public function recordsBeforeDate($date);
}