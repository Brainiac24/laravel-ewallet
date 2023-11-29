<?php
/**
 * Created by PhpStorm.
 * User: Nabijon
 * Date: 24.08.2021
 * Time: 16:13
 */

namespace App\Repositories\Backend\User\UserHistoryDwh;

use App\Models\User\UserHistoryDwh\UserHistoryDwh;

class UserHistoryDwhEloquentRepository implements UserHistoryDwhRepositoryContract
{

    public function create(array $userHistory)
    {
        $userHistoryDwh = new UserHistoryDwh();
        $userHistoryDwh->fill($userHistory);
        $userHistoryDwh->save();

        return $userHistoryDwh;
    }

    public function recordsBeforeDate($date)
    {
        $limit = config('app_settings.user_history_select_max_rows_for_dwh', null);

        if ($limit){
            return UserHistoryDwh::where('created_at', '<', $date)->limit($limit)->get();
        }

        return [];

    }

}