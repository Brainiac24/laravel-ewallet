<?php
/**
 * Created by PhpStorm.
 * User: Nabijon
 * Date: 24.08.2021
 * Time: 16:14
 */

namespace App\Repositories\Backend\User\UserHistoryDwh;


interface UserHistoryDwhRepositoryContract
{
    public function create(array $userHistory);

    public function recordsBeforeDate($date);
}