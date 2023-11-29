<?php

namespace App\Repositories\Backend\User\UserHistory;


use App\Models\User\UserHistory\UserHistory;
use App\Services\Common\Helpers\Logger\DwhRulesLogger;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

/**
 * Created by PhpStorm.
 * User: K_Hakimboev
 * Date: 19.07.2017
 * Time: 11:12
 */
class UserHistoryEloquentRepository implements UserHistoryRepositoryContract
{
    protected $userHistory;

    private $logger;

    public function __construct(UserHistory $userHistory)
    {
        $this->userHistory = $userHistory;
        $this->logger = new DwhRulesLogger();
    }

    public function getForDataTable()
    {

    }

    public function all($columns = ['*'])
    {
        $userHistory = $this->userHistory->orderBy('created_at', 'desc')->get($columns);
//        if ($users->isEmpty())
//            throw new ModelNotFoundException();
        return $userHistory;
    }

    public function paginate($perPage = 30, $columns = ['*'])
    {
        $userHistory = $this->userHistory->select($columns)->orderBy('created_at', 'desc')->paginate($perPage);
//        if ($users->isEmpty())
//            throw new ModelNotFoundException();
        return $userHistory;
    }

    public function paginateByUserId($id = null, $perPage = 30, $columns = ['*'])
    {
        
        $userHistory = $this->userHistory->select($columns)->where('user_id',$id)->with('user_events')->orderBy('created_at', 'desc')->paginate($perPage);
//        if ($users->isEmpty())
//            throw new ModelNotFoundException();
        return $userHistory;
    }

    public function listsAll()
    {
        return $this->userHistory->orderBy('created_at', 'desc')->get()->pluck('full_name', 'id');
    }

    public function create(array $data)
    {
        DB::transaction(function () use ($data, &$userHistory) {
            $this->userHistory->fill($data);
            $userHistory = $this->userHistory->save();
            if (isset($data['roles_id']))
                ($data['roles_id'] === null) ? $userHistory->roles()->sync([]) : $userHistory->roles()->sync($data['roles_id']);
        });
        return $userHistory;
    }

    public function findById($id, $columns = ['*'])
    {
//        $user = User::with('roles', 'stores')->select(['roles.display_name'])->findOrFail($id);
        $userHistory = $this->userHistory->select($columns)->findOrFail($id);
        return $userHistory;
    }

    public function findByMSISDN($msisdn, $columns = ['*'])
    {
        $userHistory = $this->userHistory->select($columns)->where('msisdn', $msisdn)->first();
        return $userHistory;
    }

    public function update(array $data, $id)
    {
        $userHistory = $this->userHistory->findOrFail($id);
        empty($data['password']) ?: $userHistory->password = $data['password'];
        DB::transaction(function () use ($userHistory, $data) {
            // если юзер садмин то невозможно изменить роля
            // if ($user->id!==USER::SADMIN)
            //{
            if (isset($data['roles_id']))
                ($data['roles_id'] === null) ? $userHistory->roles()->sync([]) : $userHistory->roles()->sync($data['roles_id']);
            //}
            $userHistory->update($data);
        });
    }

    public function lastLoginUpdate($id)
    {
        $userHistory = $this->findById($id);
        $userHistory->last_login_at = Carbon::now()->format('Y-m-d H:i:s');
        $userHistory->save();
    }

    public function destroy($id)
    {

        $userHistory = $this->findById($id);
        $userHistory->is_active = 0;
        $userHistory->save();
    }

    public function findByUserId($id)
    {
        return $this->userHistory->where('user_id',$id)->get();
    }

    public function recordsBeforeDate($date)
    {
        $limit = config('app_settings.user_history_select_max_rows_for_dwh',null);

        if ($limit){
            return $this->userHistory->where('created_at','<', $date)->limit($limit)->get();
        }
        $this->logger->warning("select limit from user history table is not set in .env");

        return [];

    }
}