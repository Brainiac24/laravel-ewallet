<?php
/**
 * Created by PhpStorm.
 * User: Nabijon
 * Date: 23.08.2021
 * Time: 16:12
 */

namespace App\Services\Backend\Web\UserHistory;


interface UserHistoryServiceContract
{
    public function copyToDwhAndRemoveOutdated($lifetimeInDays);
}