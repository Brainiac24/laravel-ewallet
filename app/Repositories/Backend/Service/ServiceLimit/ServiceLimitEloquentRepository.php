<?php
/**
 * Created by PhpStorm.
 * User: F_Kosimov
 * Date: 18.07.2018
 * Time: 15:10
 */

namespace App\Repositories\Backend\Service\ServiceLimit;


use App\Models\Service\ServiceLimit\ServiceLimit;

class ServiceLimitEloquentRepository implements ServiceLimitRepositoryContract
{

    protected $serviceLimit;

    public function __construct(ServiceLimit $serviceLimit)
    {
        $this->serviceLimit = $serviceLimit;
    }

    public function getForDataTable()
    {

    }

    public function all($columns = ['*'])
    {
        $serviceLimit = $this->serviceLimit->orderBy('created_at', 'desc')->get($columns);
        return $serviceLimit;
    }

    public function paginate($perPage = 30, $columns = ['*'])
    {
    }

    public function listsAll()
    {
        return $this->serviceLimit->orderBy('created_at', 'desc')->get()->pluck('name', 'id');
    }
    public function create(array $data)
    {
        $data['params_json'] = json_decode($data['params_json']);
        $data['extend_params_json'] = json_decode($data['extend_params_json']);
        return $this->serviceLimit->create($data);
    }

    public function findById($id, $columns = ['*'])
    {
        return $this->serviceLimit->select($columns)->findOrFail($id);
    }

    public function update(array $data, $id)
    {
        $serviceLimit = $this->serviceLimit->findOrFail($id);
        $data['params_json'] = json_decode($data['params_json']);
        $data['extend_params_json'] = json_decode($data['extend_params_json']);
        $serviceLimit->setOldAttributes($serviceLimit->getAttributes());
        $serviceLimit->update($data);
        return $serviceLimit;
    }

    public function lastLoginUpdate($id)
    {

    }

    public function destroy($id)
    {
        $serviceLimit = $this->serviceLimit->findOrFail($id);
        $serviceLimit->setOldAttributes($serviceLimit->getAttributes());
        $serviceLimit->delete();
        return $serviceLimit;
    }
}