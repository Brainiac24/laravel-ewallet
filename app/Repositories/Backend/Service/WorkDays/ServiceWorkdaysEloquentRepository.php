<?php
/**
 * Created by PhpStorm.
 * User: F_Kosimov
 * Date: 18.07.2018
 * Time: 15:10
 */

namespace App\Repositories\Backend\Service\WorkDays;

use App\Models\Service\Workday\Workday;

class ServiceWorkdaysEloquentRepository implements ServiceWorkdaysRepositoryContract
{

    protected $serviceWorkDays;

    public function __construct( Workday $serviceWorkDays)
    {
        $this->serviceWorkDays = $serviceWorkDays;
    }

    public function getForDataTable()
    {

    }

    public function all($columns = ['*'])
    {
        $serviceWorkDays = $this->serviceWorkDays->orderBy('created_at', 'desc')->get($columns);
        return $serviceWorkDays;
    }

    public function paginate($perPage = 30, $columns = ['*'])
    {
    }

    public function listsAll()
    {
        return $this->serviceWorkDays->orderBy('created_at', 'desc')->get()->pluck('name', 'id');
    }
    public function create(array $data)
    {
        return $this->serviceWorkDays->create($data);
    }

    public function findById($id, $columns = ['*'])
    {
        return $this->serviceWorkDays->select($columns)->findOrFail($id);
    }

    public function update(array $data, $id)
    {
        $serviceWorkDays = $this->serviceWorkDays->findOrFail($id);
        $serviceWorkDays->setOldAttributes($serviceWorkDays->getAttributes());
        $serviceWorkDays->update($data);
        return $serviceWorkDays;
    }

    public function lastLoginUpdate($id)
    {

    }

    public function destroy($id)
    {
        $serviceWorkDays = $this->serviceWorkDays->findOrFail($id);
        $serviceWorkDays->setOldAttributes($serviceWorkDays->getAttributes());
        $serviceWorkDays->delete();
        return $serviceWorkDays;
    }
}