<?php
/**
 * Created by PhpStorm.
 * User: Ladmin
 * Date: 17.12.2019
 * Time: 17:37
 */

namespace App\Repositories\Backend\Cashback;


use App\Events\Backend\Cashback\CashbackModifiedEvent;
use App\Models\Cashback\Cashback;
use Carbon\Carbon;

class CashbackEloquentRepository implements CashbackRepositoryContract
{

    /**
     * @var Cashback
     */
    private $cashback;

    public function __construct(Cashback $cashback)
    {
        $this->cashback = $cashback;
    }

    public function all($search)
    {
        return $this->cashback->where('name', 'like', '%' . $search . '%')->orderBy('name')->get();
    }

    public function findById($id)
    {
        return $this
            ->cashback
            ->where('id', $id)
            ->first();
    }

    public function update(array $data, $id)
    {
        $cashBack = $this->cashback->findOrFail($id);
        $cashBack->setOldAttributes($cashBack->getAttributes());
        $cashBack->update($data);
        foreach ($cashBack->getOldAttributes() as $key => $oldAttribute) {
            if (isset($data[$key]) && $data[$key] != $oldAttribute){
                if (substr($key, -4) == 'date' &&
                    Carbon::parse($data[$key])->format('Y-m-d H:i') == Carbon::parse($oldAttribute)->format('Y-m-d H:i')){
                    continue;
                }
                event(new CashbackModifiedEvent($cashBack));
                return $cashBack;
            }
        }
        return $cashBack;
    }

    public function destroy($id)
    {
        $cashBack = $this->cashback->findOrFail($id);
        $cashBack->is_active = 0;
        $cashBack->save();
        return $cashBack;
    }

    public function create(array $data)
    {
        return $this->cashback->create($data);
    }
}