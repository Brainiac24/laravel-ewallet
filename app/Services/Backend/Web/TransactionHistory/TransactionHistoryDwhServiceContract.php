<?php
/**
 * Created by PhpStorm.
 * User: Nabijon
 * Date: 27.08.2021
 * Time: 13:24
 */

namespace App\Services\Backend\Web\TransactionHistory;


interface TransactionHistoryDwhServiceContract
{
    public function findAndRemoveOutdatedDwh($lifetimeInDays);
}