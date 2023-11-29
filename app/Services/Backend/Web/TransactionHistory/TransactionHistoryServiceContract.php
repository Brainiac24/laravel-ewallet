<?php
/**
 * Created by PhpStorm.
 * User: Nabijon
 * Date: 26.08.2021
 * Time: 15:46
 */

namespace App\Services\Backend\Web\TransactionHistory;


interface TransactionHistoryServiceContract
{
    public function copyToDwhAndRemoveOutdated($lifetimeInDays);
}