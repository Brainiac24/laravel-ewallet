<?php
/**
 * Created by PhpStorm.
 * User: Ladmin
 * Date: 11.10.2019
 * Time: 9:32
 */

namespace App\Repositories\Backend\Service\ServiceOtpLimit;


use App\Models\Service\ServiceOtpLimit\Filters\ServiceOtpLimitFilter;
use App\Models\Service\ServiceOtpLimit\ServiceOtpLimit;

class ServiceOtpLimitEloquentRepository implements ServiceOtpLimitRepositoryContract
{
    /**
     * @var ServiceOtpLimit
     */
    private $serviceOtpLimit;

    public function __construct(ServiceOtpLimit $serviceOtpLimit)
    {
        $this->serviceOtpLimit = $serviceOtpLimit;
    }

    public function all($search)
    {
        return $this->serviceOtpLimit->where('name', 'like', '%' . $search . '%')->orderBy('name')->get();
    }

    public function listsAll()
    {
        return $this->serviceOtpLimit->orderBy('created_at', 'desc')->get()->pluck('name', 'id');
    }

    public function paginate($data = [], $perPage = 30, $columns = ['*'])
    {
        return $this->serviceOtpLimit->select($columns)->filterBy(new ServiceOtpLimitFilter($data))->orderBy('created_at', 'desc')->paginate($perPage);
    }

    public function findById($id)
    {
        return $this->serviceOtpLimit->where('id', $id)->first();
    }

    public function update(array $data, $id)
    {
        $serviceOtpLimit = $this->serviceOtpLimit->findOrFail($id);
        $data['params_json'] = json_decode($data['params_json']);
        $serviceOtpLimit->setOldAttributes($serviceOtpLimit->getAttributes());
        $serviceOtpLimit->update($data);
        return $serviceOtpLimit;
    }

    public function destroy($id)
    {
        $serviceOtpLimit = $this->serviceOtpLimit->findOrFail($id);
        $serviceOtpLimit->save();
        return $serviceOtpLimit;
    }

    public function create(array $data)
    {
        $data['params_json'] = json_decode($data['params_json']);
        return $this->serviceOtpLimit->create($data);
    }
}