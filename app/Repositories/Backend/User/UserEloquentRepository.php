<?php

namespace App\Repositories\Backend\User;

use App\Models\User\Filters\UserFilter;
use App\Models\User\User;
use App\Services\Common\Helpers\AccountTypes;
use App\Services\Common\Helpers\Attestation;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

/**
 * Created by PhpStorm.
 * User: K_Hakimboev
 * Date: 19.07.2017
 * Time: 11:12
 */
class UserEloquentRepository implements UserRepositoryContract
{
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function getForDataTable()
    {

    }

    public function all($columns = ['*'])
    {
        $users = $this->user->get($columns);
//        if ($users->isEmpty())
        //            throw new ModelNotFoundException();
        return $users;
    }

    public function getAllUserWhereNotNullUserSettingsJson()
    {
        return $this->user::whereNotNull("user_settings_json")->get();
    }

    public function paginate($data = [], $perPage = 30, $columns = ['*'])
    {
        return $this->user->select($columns)->IsUser()->with('roles')->orderBy('created_at', 'desc')->filterBy(new UserFilter($data))->paginate($perPage);
    }

    public function listAllIsAdmin()
    {
        return $this->user
            ->where('is_active',1)
            ->where('is_admin',1)
            ->get()
            ->pluck('fullNameExtendedFormat','id')
            ->toArray();
    }

    public function listsAll()
    {
        return $this->user->get()->pluck('full_name', 'id');
    }

    public function listsAllIsActive()
    {
        return $this->user
            ->where('is_active','=',1)
            ->where('is_admin','=',0)
            ->get()
            ->pluck('id')
            ->toArray();
    }
    /**
     * @param array $data
     * @return User
     * @throws \Throwable
     */
    public function create(array $data)
    {

        $user = new User($data);
        $user->password = bcrypt($data['password']);
        $user->msisdn = $data['msisdn'] ?? null;
        $user->username = $data['username'];
        $user->description = $data['description'] ?? null;

        $user->first_name = $data['first_name'] ?? null;
        $user->middle_name = $data['middle_name'] ?? null;
        $user->last_name = $data['last_name'] ?? null;

        $user->is_admin = 1;
        $user->is_active = 1;
        $user->attestation_id = config('app_settings.default_attestation_id');

        DB::transaction(function () use ($data, &$user) {

            $user->save();

            if (isset($data['roles_id'])) {
                ($data['roles_id'] === null) ? $user->roles()->sync([]) : $user->roles()->sync($data['roles_id']);
            } else {
                $user->roles()->sync([]);
            }

            if (isset($data['branches_id'])) {
                ($data['branches_id'] === null) ? $user->branches()->sync([]) : $user->branches()->sync($data['branches_id']);
            } else {
                $user->branches()->sync([]);
            }

        });

        return $user;
    }

    public function findById($id, $columns = ['*'])
    {

//        $user = User::with('roles', 'stores')->select(['roles.display_name'])->findOrFail($id);
        $user = $this
            ->user
//            ->with(['user_histories' => function ($q) {
//            $q->with('user_events')->orderBy('created_at', 'desc');
//        }])
            ->select($columns)->findOrFail($id);
        return $user;
    }

    public function findByMSISDN($msisdn, $columns = ['*'])
    {
        $user = $this->user->with('attestation')->with(['accountsWithoutGlobalScope' => function ($q) {
            $q->where('account_type_id', '=', config('app_settings.default_wallet_account_type_id'));
        }])->where('msisdn', $msisdn)->first();

//        dd($user->accountsWithoutGlobalScope);
        return $user;
    }

    public function update(array $data, $id)
    {
//        dd($data);
        $user = $this->user->findOrFail($id);
        $user->msisdn = $data['msisdn'] ?? null;
        $user->username = $data['username'];
        $user->description = $data['description'] ?? null;

        $user->first_name = $data['first_name'] ?? null;
        $user->middle_name = $data['middle_name'] ?? null;
        $user->last_name = $data['last_name'] ?? null;

        $user->is_admin = 1;
        $user->is_active = 1;

        $password_params_json = !empty($user->password_params_json) ? $user->password_params_json : [];
        $password_params_json["is_change_password"] = true;
        $user->password_params_json = $password_params_json;

        empty($data['password']) ?: $user->password = bcrypt($data['password']);
        DB::transaction(function () use ($data, &$user) {
            if (isset($data['roles_id'])) {
                ($data['roles_id'] === null) ? $user->roles()->sync([]) : $user->roles()->sync($data['roles_id']);
            } else {
                $user->roles()->sync([]);
            }

            if (isset($data['branches_id'])) {
                ($data['branches_id'] === null) ? $user->branches()->sync([]) : $user->branches()->sync($data['branches_id']);
            } else {
                $user->branches()->sync([]);
            }

            $user->save();
        });

        return $user;
    }

    public function lastLoginUpdate($id)
    {
        $user = $this->findById($id);
        $user->last_login_at = Carbon::now()->format('Y-m-d H:i:s');
        $user->save();
        return $user;
    }

    public function destroy($id)
    {

        $user = $this->findById($id);
        $user->is_active = 0;
        $user->save();
        return $user;
    }

    public function unlock($id)
    {
        $user = $this->findById($id);
        $user->is_active = 1;

        $password_params_json = !empty($user->password_params_json) ? $user->password_params_json : [];
        $password_params_json["is_change_password"] = true;
        $user->password_params_json = $password_params_json;
        
        $user->save();
        return $user;
    }

    public function block($id)
    {
        $user = $this->findById($id);
        $user->is_active = 0;
        $user->blocked_count = $user->blocked_count + 1;
        $user->save();
        return $user;
    }

    public function deleteEmail($id)
    {
        $user = $this->findById($id);
        $user->email = null;
        $user->save();
        return $user;
    }

    public function getNotIdentificatedUsersList()
    {
        return $this->user->withoutGlobalScopes()->where('attestation_id', Attestation::NOT_IDENTIFIED)->where(function ($query) {
            $query->where('verification_params_json', "LIKE", '%"is_verified":0%')
                  ->orWhereNull('verification_params_json');
        })->where('is_admin', '!=', '1')->where('is_auth', '=', '1')->get();
    }

    public function getUserByCodeMapAndMsisdn($code_map, $msisdn)
    {
        return $this->user->withoutGlobalScopes()->where('code_map', $code_map)->where('msisdn', '<>', $msisdn)->first();
    }

    public function allClients($columns = ['*'])
    {
        //$this->user->where('is_admin', false)->get($columns);

        return DB::table('users')
        ->leftJoin('accounts', function($join)
        {
            $join->on('users.id', '=', 'accounts.user_id')->where('accounts.account_type_id', '=', AccountTypes::EWALLET_BONUS);
        })
        ->where('users.id', '!=', 'd09550a6-bfaf-11e8-9676-b06ebfbfa715')
        ->where('is_admin', false)
        ->whereNull('accounts.id')
        ->get(['users.id']);
    }

    public function getByIds($ids){
        return $this->user
            ->whereIn('id', $ids)
            ->get();
    }


}
