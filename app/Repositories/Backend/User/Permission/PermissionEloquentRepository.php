<?php
/**
 * Created by PhpStorm.
 * User: K_Hakimboev
 * Date: 25.07.2017
 * Time: 16:42
 */

namespace App\Repositories\Backend\User\Permission;

use App\Models\User\Permission\Permission;

class PermissionEloquentRepository implements PermissionRepositoryContract
{
    protected $perm;

    /**
     * RoleRepository constructor.
     * @param $perm
     */
    public function __construct(Permission $perm)
    {
        $this->perm = $perm;
    }

    /**
     * @param array $columns
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function all($columns = ['*'])
    {
        $perms = $this->perm->orderBy('created_at', 'desc')->get($columns);

//        if ($users->isEmpty())
//            throw new ModelNotFoundException();

        return $perms;
    }

    /**
     * @param int $perPage
     * @param array $columns
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function paginate($perPage = 30, $columns = ['*'])
    {
        $perms = $this->perm->select($columns)->paginate($perPage);

//        if ($users->isEmpty())
//            throw new ModelNotFoundException();

        return $perms;
    }

    public function listAll()
    {
        $perms = $this->perm->orderBy('display_name', 'asc')->pluck('display_name', 'id');

        return $perms;
    }
}