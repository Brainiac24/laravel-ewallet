<?php
/**
 * Created by PhpStorm.
 * User: K_Hakimboev
 * Date: 25.07.2017
 * Time: 16:42
 */

namespace App\Repositories\Backend\User\Role;

use App\Models\User\Role\Role;
use Illuminate\Support\Facades\DB;

class RoleEloquentRepository implements RoleRepositoryContract
{
    protected $role;

    /**
     * RoleRepository constructor.
     * @param $role
     */
    public function __construct(Role $role)
    {
        $this->role = $role;
    }

    /**
     * @param array $columns
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function all($columns = ['*'])
    {
        return $this->role->orderBy('created_at', 'desc')->get($columns);

    }

    /**
     * @param int $perPage
     * @param array $columns
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function paginate($perPage = 30, $columns = ['*'])
    {
        return $this->role->select($columns)->paginate($perPage);
    }

    public function listsAll()
    {
        return $this->role->pluck('display_name', 'id');
    }

    /**
     * @param array $data
     */
    public function create(array $data)
    {
        $role = null;
        DB::transaction(function () use (&$role, $data) {

            $role = $this->role->create($data);

            (!isset($data['permission_ids']) || $data['permission_ids'] === null) ? $role->permissions()->sync([]) : $role->permissions()->sync($data['permission_ids']);
        });
        return $role;
    }

    /**
     * @param $id
     * @param array $columns
     * @return mixed
     */
    public function findById($id, $columns = ['*'])
    {
        $role = $this->role->with('permissions')->select($columns)->findOrFail($id);

        return $role;
    }


    /**
     * @param array $data
     * @param $id
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model
     */
    public function update(array $data, $id)
    {
        $role = $this->role->findOrFail($id);
        $role->setOldAttributes($role->getAttributes());
        DB::transaction(function () use (&$role, $data) {
            $role->update($data);
            (!isset($data['permission_ids']) || $data['permission_ids'] === null) ? $role->permissions()->sync([]) : $role->permissions()->sync($data['permission_ids']);
        });

        return $role;
    }

    /**
     * @param int $id
     */
    public function destroy($id)
    {
        $role = $this->role->findOrFail($id);
        $role->setOldAttributes($role->getAttributes());
        $role->delete();
        return $role;
    }
}