<?php
/**
 * Created by PhpStorm.
 * User: Nabijon
 * Date: 27.08.2021
 * Time: 13:12
 */

namespace App\Services\Backend\Web\UserHistory;


interface UserHistoryDwhServiceContract
{
    public function findAndRemoveOutdatedDwh($lifetimeInDays);
}