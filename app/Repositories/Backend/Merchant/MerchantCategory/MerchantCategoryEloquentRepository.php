<?php
/**
 * Created by PhpStorm.
 * User: Ladmin
 * Date: 17.12.2019
 * Time: 10:03
 */

namespace App\Repositories\Backend\Merchant\MerchantCategory;


use App\Models\Merchant\MerchantCategory\MerchantCategory;

class MerchantCategoryEloquentRepository implements MerchantCategoryRepositoryContract
{

    /**
     * @var MerchantCategory
     */
    private $merchantCategory;

    public function __construct(MerchantCategory $merchantCategory)
    {
        $this->merchantCategory = $merchantCategory;
    }

    public function all($columns = ['*'])
    {
        return $this->merchantCategory->orderBy('name')->get($columns);
    }

    public function findById($id)
    {
        return $this
            ->merchantCategory
            ->where('id', $id)
            ->first();
    }

    public function update(array $data, $id)
    {
        $merchantCategory = $this->merchantCategory->findOrFail($id);
        $merchantCategory->setOldAttributes($merchantCategory->getAttributes());
        $merchantCategory->update($data);
        return $merchantCategory;
    }

    public function destroy($id)
    {
        $merchantCategory = $this->merchantCategory->findOrFail($id);
        $merchantCategory->is_active = 0;
        $merchantCategory->save();
        return $merchantCategory;
    }

    public function create(array $data)
    {
        return $this->merchantCategory->create($data);
    }
}