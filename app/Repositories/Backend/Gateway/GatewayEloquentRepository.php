<?php
/**
 * Created by PhpStorm.
 * User: F_Kosimov
 * Date: 18.07.2018
 * Time: 15:10
 */

namespace App\Repositories\Backend\Gateway;

use App\Models\Gateway\Filters\GatewayFilter;
use App\Models\Gateway\Gateway;

class GatewayEloquentRepository implements GatewayRepositoryContract
{
    protected $category;

    public function __construct(Gateway $gateway)
    {

        $this->gateway = $gateway;

    }

    public function getForDataTable()
    {

    }

    public function all($data=[],$columns = ['*'])
    {
        $gateway = $this->gateway->orderBy('created_at', 'desc')->filterBy(new GatewayFilter($data))->get($columns);
        return $gateway;
    }

    public function paginate($perPage = 30, $columns = ['*'])
    {
    }

    public function listsAll()
    {
        return $this->gateway->orderBy('created_at', 'desc')->get()->pluck('name', 'id');
    }

    public function create(array $data)
    {
        return $this->gateway->create($data);
    }

    public function findById($id, $columns = ['*'])
    {
        return $this->gateway->select($columns)->findOrFail($id);
    }

    public function update(array $data, $id)
    {
        $gateway = $this->gateway->findOrFail($id);
        $gateway->setOldAttributes($gateway->getAttributes());
        $gateway->update($data);
        return $gateway;
    }

    public function lastLoginUpdate($id)
    {

    }

    public function destroy($id)
    {
        $gateway = $this->gateway->findOrFail($id);
        $gateway->setOldAttributes($gateway->getAttributes());
        $gateway->delete();
        return $gateway;
    }

    public function onOff($is_active, $id)
    {
        $gateway = $this->findById($id);
        $gateway->is_active = $is_active;
        $gateway->is_enabled_for_account = $is_active;
        $gateway->is_enabled_for_service = $is_active;
        $gateway->save();
    }
}