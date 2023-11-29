<?php
/**
 * Created by PhpStorm.
 * User: Ladmin
 * Date: 24.02.2020
 * Time: 10:29
 */

namespace App\Repositories\Backend\Merchant\MerchantCommissionItem;


use App\Models\Merchant\MerchantCommissionItem\Filters\MerchantCommissionItemFilter;
use App\Models\Merchant\MerchantCommissionItem\MerchantCommissionItem;

class MerchantCommissionItemEloquentRepository implements MerchantCommissionItemRepositoryContract
{
    /**
     * @var MerchantCommissionItem
     */
    private $merchantCommissionItem;

    /**
     * MerchantCommissionItemEloquentRepository constructor.
     * @param MerchantCommissionItem $merchantCommissionItem
     */
    public function __construct(MerchantCommissionItem $merchantCommissionItem)
    {
        $this->merchantCommissionItem = $merchantCommissionItem;
    }

    public function all($search)
    {
        return $this->merchantCommissionItem->where('name', 'like', '%' . $search . '%')->orderBy('name')->get();
    }

    public function paginate($data = [], $perPage = 30, $columns = ['*'])
    {
        return $this->merchantCommissionItem
            ->select($columns)
            ->filterBy(new MerchantCommissionItemFilter($data))
            ->with('merchant_commission')
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);
    }

    public function findById($id)
    {
        return $this
            ->merchantCommissionItem
            ->where('id', $id)
            ->with('merchant_commission')
            ->first();
    }

    public function findByMerchantCommissionId($merchant_commission_id)
    {
        return $this
            ->merchantCommissionItem
            ->where('merchant_commission_id', $merchant_commission_id)
            ->with('merchant_commission')
            ->first();
    }
    public function update(array $data, $id)
    {
        $merchantCommissionItem = $this->merchantCommissionItem->findOrFail($id);
        $merchantCommissionItem->setOldAttributes($merchantCommissionItem->getAttributes());
        $merchantCommissionItem->update($data);
        return $merchantCommissionItem;
    }

    /**
     * @param $id
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model
     * @throws \Exception
     */
    public function destroy($id)
    {
        $merchantCommissionItem = $this->merchantCommissionItem->findOrFail($id);
//        $merchantCommissionItem->is_active = 0;
        $merchantCommissionItem->delete();
        return $merchantCommissionItem;
    }

    public function create(array $data)
    {
        return $this->merchantCommissionItem->create($data);
    }

    public function GetAllMerchantCommissionById($merchant_commission_id)
    {
        return $this
            ->merchantCommissionItem
            ->where('merchant_commission_id',$merchant_commission_id)
            //->with('merchant')
            ->orderBy('created_at')
            ->get();
    }

    public function GetMaxValueFromColumnMaxByMerchantCommissionId($merchant_commission_id)
    {
        return $this->merchantCommissionItem->where('merchant_commission_id',$merchant_commission_id)->max('max');
    }
}