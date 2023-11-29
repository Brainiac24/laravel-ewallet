<?php
/**
 * Created by PhpStorm.
 * User: F_Kosimov
 * Date: 18.07.2018
 * Time: 15:10
 */

namespace App\Repositories\Backend\Currency\CurrencyRate;


use App\Events\Backend\Currency\CurrencRate\CurrencyRateModified;
use App\Models\Currency\CurrencyRate\CurrencyRate;
use App\Models\Currency\Filters\CurrencyRateFilter;
use App\Services\Common\Helpers\CurrencyRateCategory;

class CurrencyRateEloquentRepository implements CurrencyRateRepositoryContract
{
    protected $currencyRate;

    public function __construct(CurrencyRate $currencyRate)
    {

        $this->currencyRate = $currencyRate;

    }

    public function getForDataTable()
    {

    }

    public function all($columns = ['*'])
    {
        $currencyRate = $this->currencyRate->orderBy('created_at', 'desc')->get($columns);
        return $currencyRate;
    }

    public function paginate($data=[],$perPage = 30, $columns = ['*'])
    {
        return $this->currencyRate->select($columns)->with(['currency','currency_rate_category'])->filterBy(new CurrencyRateFilter($data))->orderBy('created_at', 'desc')->paginate($perPage);
    }

    public function listsAll()
    {
        return $this->currencyRate->orderBy('created_at', 'desc')->get()->pluck('name', 'id');
    }

    public function create(array $data)
    {
        $currencyRate = $this->currencyRate->create($data);

        return $currencyRate;
    }

    public function findById($id, $columns = ['*'])
    {
        return $this->currencyRate->select($columns)->findOrFail($id);
    }

    public function update(array $data, $id)
    {
        $currencyRate = $this->currencyRate->findOrFail($id);
        $currencyRate->setOldAttributes($currencyRate->getAttributes());
        $currencyRate->update($data);
        event(new CurrencyRateModified($currencyRate));
        return $currencyRate;
    }

    /**
     * @param $value_buy
     * @param $value_sell
     * @param $currency_id
     * @return CurrencyRate|\Illuminate\Database\Eloquent\Model|null|object
     * @throws \Exception
     */
    public function createOrUpdateByCurrencyId($value_buy, $value_sell, $currency_id, $type_rate)
    {
        $rate = $this->currencyRate->where('currency_id', $currency_id)->where('currency_rate_category_id', CurrencyRateCategory::UUID[$type_rate])->first();

        \DB::beginTransaction();

        try {
            if ($rate === null) {
                $rate = new CurrencyRate();
                $rate->value_buy = $value_buy;
                $rate->value_sell = $value_sell;
                $rate->currency_id = $currency_id;
                $rate->currency_rate_category_id = CurrencyRateCategory::UUID[$type_rate];
                $rate->save();
            } else {
                $rate->value_buy = $value_buy;
                $rate->value_sell = $value_sell;
                $rate->save();
            }

            event(new CurrencyRateModified($rate));

            \DB::commit();

        } catch (\Exception $e) {
            \DB::rollBack();
            \Log::error('Ошибка при сохранении курса валют.' . $e->getMessage());
        }

        return $rate;
    }

    public function lastLoginUpdate($id)
    {

    }

    public function destroy($id)
    {
        $currencyRate = $this->currencyRate->findOrFail($id);
        $currencyRate->is_active = 0;
        $currencyRate->save();
        return $currencyRate;
    }
}