<?php
/**
 * Created by PhpStorm.
 * User: F_Kosimov
 * Date: 18.07.2018
 * Time: 15:10
 */

namespace App\Repositories\Backend\Service\Commission;

use App\Models\Service\Commission\Commission;
use Ramsey\Uuid\Uuid;

class CommissionEloquentRepository implements CommissionRepositoryContract
{
    protected $commission;

    public function __construct(Commission $commission)
    {
        $this->commission = $commission;
    }

    public function getForDataTable()
    {

    }

    public function all($columns = ['*'])
    {
        $commission = $this->commission->orderBy('created_at', 'desc')->get($columns);
        return $commission;
    }

    public function paginate($perPage = 30, $columns = ['*'])
    {
    }

    public function listsAll()
    {
        return $this->commission->orderBy('created_at', 'desc')->get()->pluck('name', 'id');
    }

    public function create(array $data)
    {
        return $this->commission->create($data);
    }

    public function createDataByID(array $data, $id)
    {

        $commission = $this->commission->findOrFail($id);
        $commission->setOldAttributes($commission->getAttributes());
        $params_json = $commission->params_json;
        $uuid = (string)Uuid::uuid4();
        $data['id'] = $uuid;
        array_push($params_json, $data);

        usort($params_json, function ($a, $b) {
            if($a['min']==$b['min']) return 0;
            return $a['min'] < $b['min']?-1:1;
        });

        $commission->params_json = $params_json;
        $commission->save();

        return $commission;
    }

    public function findById($id, $columns = ['*'])
    {
        return $this->commission->select($columns)->findOrFail($id);
    }

    public function update(array $data, $id)
    {
        $commission = $this->commission->findOrFail($id);
        $commission->setOldAttributes($commission->getAttributes());
        $commission->update($data);
        return $commission;
    }

    public function lastLoginUpdate($id)
    {

    }

    public function destroy($id)
    {
        $commission = $this->commission->findOrFail($id);
        $commission->setOldAttributes($commission->getAttributes());
        $commission->delete();
        return $commission;
    }

    public function destroyCommissionData($param_json_id, $id)
    {
        $commission = $this->commission->findOrFail($id);
        $commission->setOldAttributes($commission->getAttributes());
        $params_json = $commission->params_json;
        $datatemp = [];
        foreach ($params_json as $key => $value) {
            if ($value['id'] != $param_json_id) {
                array_push($datatemp, $params_json[$key]);
            }
        }
        usort($datatemp, function ($a, $b) {
            if($a['min']==$b['min']) return 0;
            return $a['min'] < $b['min']?-1:1;
        });
        $commission->params_json = $datatemp;
        $commission->save();
        return $commission;
    }
}