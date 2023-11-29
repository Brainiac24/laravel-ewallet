<?php
/**
 * Created by PhpStorm.
 * User: Ladmin
 * Date: 17.12.2019
 * Time: 15:04
 */

namespace App\Repositories\Backend\Merchant\MerchantWorkdays;

use App\Events\Backend\Cashback\CashbackItem\CashbackItemModifiedEvent;
use App\Events\Backend\Merchant\MerchantWorkday\MerchantWorkdayModifiedEvent;
use App\Models\Merchant\MerchantWorkdays\MerchantWorkdays;

class MerchantWorkdaysEloquentRepository implements MerchantWorkdaysRepositoryContract
{
    /**
     * @var MerchantWorkdays
     */
    private $merchantWorkdays;

    /**
     * MerchantWorkdaysEloquentRepository constructor.
     * @param MerchantWorkdays $merchantWorkdays
     */
    public function __construct(MerchantWorkdays $merchantWorkdays)
    {

        $this->merchantWorkdays = $merchantWorkdays;
    }

    public function all($search)
    {
        return $this->merchantWorkdays->where('name', 'like', '%' . $search . '%')->orderBy('name')->get();
    }

    public function findById($id)
    {
        return $this
            ->merchantWorkdays
            ->where('id', $id)
            ->first();
    }

    public function update(array $data, $id)
    {
        $merchantWorkdays = $this->merchantWorkdays->findOrFail($id);
        $merchantWorkdays->setOldAttributes($merchantWorkdays->getAttributes());
        $merchantWorkdays->update($data);
        foreach ($merchantWorkdays->getOldAttributes() as $key => $oldAttribute) {
            if (isset($data[$key]) && $data[$key] != $oldAttribute && $key != 'updated_at'){
                event(new MerchantWorkdayModifiedEvent($merchantWorkdays));
                return $merchantWorkdays;
            }
        }
        return $merchantWorkdays;
    }

    public function destroy($id)
    {
        $merchantWorkdays = $this->merchantWorkdays->findOrFail($id);
        $merchantWorkdays->is_active = 0;
        $merchantWorkdays->save();
        return $merchantWorkdays;
    }

    public function create(array $data)
    {
        return $this->merchantWorkdays->create($data);
    }
}