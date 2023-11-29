<?php
/**
 * Created by PhpStorm.
 * User: Ladmin
 * Date: 20.12.2019
 * Time: 14:29
 */

namespace App\Repositories\Backend\Cashback\CashbackItem;


use App\Events\Backend\Cashback\CashbackItem\CashbackItemModifiedEvent;
use App\Models\Cashback\CashbackItem\CashbackItem;

class CashbackItemEloquentRepository implements CashbackItemRepositoryContract
{
    /**
     * @var CashbackItem
     */
    private $cashbackItem;

    /**
     * CashbackItemEloquentRepository constructor.
     * @param CashbackItem $cashbackItem
     */
    public function __construct(CashbackItem $cashbackItem)
    {
        $this->cashbackItem = $cashbackItem;
    }

    public function all($columns = ['*'])
    {
        return $this->cashbackItem
            //->with('cashback')
            ->orderBy('min','DESC')->get($columns);
    }

    public function GetAllByCashbackId($cashback_id)
    {
        return $this->cashbackItem
            ->where('cashback_id',$cashback_id)
            ->orderBy('min')//,'DESC'
            ->get();
    }

    public function GetMaxValueFromColumnMaxByCashbackId($cashback_id)
    {
        return $this->cashbackItem->where('cashback_id',$cashback_id)->max('max');
    }

    public function GetMaxValueFromColumnValueByCashbackId($merchant_cashback_id, $bank_cashback_id)
    {
        $merchant_cashback = $this->cashbackItem
            ->where('cashback_id',$merchant_cashback_id)
            ->where('is_percentage',1)
            ->max('value');

        $bank_cashback = $this->cashbackItem
            ->where('cashback_id',$bank_cashback_id)
            ->where('is_percentage',1)
            ->max('value');

        return $merchant_cashback + $bank_cashback;
    }
    public function findById($id)
    {
        return $this
            ->cashbackItem
            ->where('id', $id)
            ->first();
    }

    public function update(array $data, $id)
    {
        $cashBack = $this->cashbackItem->findOrFail($id);
        $cashBack->setOldAttributes($cashBack->getAttributes());
        $cashBack->update($data);
        foreach ($cashBack->getOldAttributes() as $key => $oldAttribute) {
            if (isset($data[$key]) && $data[$key] != $oldAttribute && $key != 'updated_at'){
                event(new CashbackItemModifiedEvent($cashBack));
                return $cashBack;
            }
        }
        return $cashBack;
    }

    public function destroy($id)
    {
        $cashBack = $this->cashbackItem->findOrFail($id);
        //$cashBack->is_active = 0;
        $cashBack->delete();
        return $cashBack;
    }

    public function create(array $data)
    {
        $cashBack = $this->cashbackItem->create($data);
        event(new CashbackItemModifiedEvent($cashBack));
        return $cashBack;

    }
}