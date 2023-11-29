<?php
/**
 * Created by PhpStorm.
 * User: Ladmin
 * Date: 24.02.2020
 * Time: 10:13
 */

namespace App\Repositories\Backend\Merchant\MerchantCommission;


use App\Models\Merchant\MerchantCommission\Filters\MerchantCommissionFilter;
use App\Models\Merchant\MerchantCommission\MerchantCommission;

class MerchantCommissionEloquentRepository implements MerchantCommissionRepositoryContract
{
    /**
     * @var MerchantCommission
     */
    private $merchantCommission;

    /**
     * MerchantCommissionEloquentRepository constructor.
     * @param MerchantCommission $merchantCommission
     */
    public function __construct(MerchantCommission $merchantCommission)
    {
        $this->merchantCommission = $merchantCommission;
    }

    public function all($search)
    {
        return $this->merchantCommission->where('name', 'like', '%' . $search . '%')->orderBy('name')->get();
    }

    public function paginate($data = [], $perPage = 30, $columns = ['*'])
    {
        return $this->merchantCommission
            ->select($columns)
            ->filterBy(new MerchantCommissionFilter($data))
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);
    }

    public function findById($id)
    {
        return $this->merchantCommission->where('id', $id)->first();
    }

    public function update(array $data, $id)
    {
        $merchantCommission= $this->merchantCommission->findOrFail($id);
        $merchantCommission->setOldAttributes($merchantCommission->getAttributes());
        $merchantCommission->update($data);
        return $merchantCommission;
    }

    public function destroy($id)
    {
        $merchantCommission = $this->merchantCommission->findOrFail($id);
        $merchantCommission->is_active = 0;
        $merchantCommission->save();
        return $merchantCommission;
    }

    public function create(array $data)
    {
        return $this->merchantCommission->create($data);
    }
}