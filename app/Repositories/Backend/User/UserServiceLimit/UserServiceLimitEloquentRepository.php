<?php

namespace App\Repositories\Backend\User\UserServiceLimit;

use App\Models\User\Filters\UserServiceLimitsFilter;
use App\Models\User\UserServiceLimit\UserServiceLimit;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

/**
 * Created by PhpStorm.
 * User: F Kosimov
 * Date: 02.08.2018
 * Time: 11:12
 */
class UserServiceLimitEloquentRepository implements UserServiceLimitRepositoryContract
{
    protected $userServiceLimit;

    public function __construct(UserServiceLimit $userServiceLimit)
    {
        $this->userServiceLimit = $userServiceLimit;
    }

    public function getForDataTable()
    {

    }

    public function all($columns = ['*'])
    {
        $userServiceLimit = $this->userServiceLimit->orderBy('created_at', 'desc')->get($columns);
        return $userServiceLimit;
    }

    public function paginate($data = [], $perPage = 30, $columns = ['*'])
    {
        return $this->userServiceLimit->select($columns)->with('service.service_limit', 'user', 'service')->filterBy(new UserServiceLimitsFilter($data))->orderBy('created_at', 'desc')->paginate($perPage);
  }

    public function listsAll()
    {
        return $this->userServiceLimit->get()->pluck('full_name', 'id');
    }

    public function create(array $data)
    {
        $userServiceLimit = null;
        DB::transaction(function () use ($data, &$userServiceLimit) {
            $this->userServiceLimit->fill($data);
            $userServiceLimit = $this->userServiceLimit;
            $userServiceLimit->save();
            if (isset($data['roles_id'])) {
                ($data['roles_id'] === null) ? $userServiceLimit->roles()->sync([]) : $userServiceLimit->roles()->sync($data['roles_id']);
            }

        });
        return $userServiceLimit;
    }

    public function findById($id, $columns = ['*'])
    {
//        $user = User::with('roles', 'stores')->select(['roles.display_name'])->findOrFail($id);
        $userServiceLimit = $this->userServiceLimit->select($columns)->findOrFail($id);
        return $userServiceLimit;
    }

    public function findByMSISDN($msisdn, $columns = ['*'])
    {
        $userServiceLimit = $this->userServiceLimit->select($columns)->where('msisdn', $msisdn)->first();
        return $userServiceLimit;
    }

    public function update(array $data, $id)
    {
        $userServiceLimit = $this->userServiceLimit->findOrFail($id);
        $userServiceLimit->setOldAttributes($userServiceLimit->getAttributes());
        $data['params_json'] = json_decode($data['params_json']);

        empty($data['password']) ?: $userServiceLimit->password = $data['password'];
        DB::transaction(function () use (&$userServiceLimit, $data) {
            if (isset($data['roles_id'])) {
                ($data['roles_id'] === null) ? $userServiceLimit->roles()->sync([]) : $userServiceLimit->roles()->sync($data['roles_id']);
            }

            $userServiceLimit->update($data);
        });
        return $userServiceLimit;
    }

    public function lastLoginUpdate($id)
    {
        $userServiceLimit = $this->findById($id);
        $userServiceLimit->last_login_at = Carbon::now()->format('Y-m-d H:i:s');
        $userServiceLimit->save();
        return $userServiceLimit;
    }

    public function destroy($id)
    {
        //dd(123);
        $userServiceLimit = $this->userServiceLimit->findOrFail($id);
        $userServiceLimit->setOldAttributes($userServiceLimit->getAttributes());
        $userServiceLimit->delete();
        return $userServiceLimit;
    }
    public function findByUserId($id)
    {
        return $this->userServiceLimit->where('user_id', $id)->get();
    }
}
