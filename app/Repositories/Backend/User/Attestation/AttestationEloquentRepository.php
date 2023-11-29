<?php
/**
 * Created by PhpStorm.
 * User: K_Hakimboev
 * Date: 25.07.2017
 * Time: 16:42
 */

namespace App\Repositories\Backend\User\Attestation;

use App\Models\User\Attestation\Attestation;
use Illuminate\Support\Facades\DB;

class AttestationEloquentRepository implements AttestationRepositoryContract
{
    protected $attestation;

    /**
     * RoleRepository constructor.
     * @param $attestation
     */
    public function __construct(Attestation $attestation)
    {
        $this->attestation = $attestation;
    }

    /**
     * @param array $columns
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function all($columns = ['*'])
    {
        return $this->attestation->orderBy('created_at', 'desc')->get($columns);

    }

    /**
     * @param int $perPage
     * @param array $columns
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function paginate($perPage = 30, $columns = ['*'])
    {
        //  return $this->attestation->select($columns)->paginate($perPage);
    }

    public function listsAll()
    {
        return $this->attestation->orderBy('name')->get()->pluck('name', 'id');
    }

    /**
     * @param array $data
     */
    public function create(array $data)
    {   $item =null;
        DB::transaction(function () use ($data, &$item) {
            $item = $this->attestation->create($data);
            //(!isset($data['permission_ids']) || $data['permission_ids'] === null) ? $item->permissions()->sync([]) : $item->permissions()->sync($data['permission_ids']);
        });

        return $item;
    }

    /**
     * @param $id
     * @param array $columns
     * @return mixed
     */
    public function findById($id, $columns = ['*'])
    {
        $item = $this->attestation->select($columns)->findOrFail($id);
        return $item;
    }


    /**
     * @param array $data
     * @param $id
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model
     */
    public function update(array $data, $id)
    {
        $attestation = $this->attestation->findOrFail($id);
        $attestation->setOldAttributes($attestation->getAttributes());
        $attestation->update($data);
        return $attestation;
    }

    /**
     * @param int $id
     */
    public function destroy($id)
    {
        $attestation = $this->attestation->findOrFail($id);
        $attestation->setOldAttributes($attestation->getAttributes());
        $attestation->delete();
        return $attestation;
    }
}