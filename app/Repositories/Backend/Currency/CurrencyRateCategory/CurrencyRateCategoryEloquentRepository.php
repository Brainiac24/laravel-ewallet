<?php
/**
 * Created by PhpStorm.
 * User: F_Kosimov
 * Date: 18.07.2018
 * Time: 15:10
 */

namespace App\Repositories\Backend\Currency\CurrencyRateCategory;

use App\Events\Backend\Currency\CurrencRateCategory\CurrencyRateCategoryModified;
use App\Models\Currency\CurrencyRateCategory\CurrencyRateCategory;


class CurrencyRateCategoryEloquentRepository implements CurrencyRateCategoryRepositoryContract
{
    protected $currencyRateCategory;

    public function __construct(CurrencyRateCategory $currencyRateCategory)
    {

        $this->currencyRateCategory = $currencyRateCategory;

    }

    public function getForDataTable()
    {

    }

    public function all($columns = ['*'])
    {
        $currencyRateCategory = $this->currencyRateCategory->orderBy('created_at', 'desc')->get($columns);
        return $currencyRateCategory;
    }

    public function paginate($data=[],$perPage = 30, $columns = ['*'])
    {
        return $this->currencyRateCategory->selesct($columns)->orderBy('created_at', 'desc')->paginate($perPage);
    }

    public function listsAll()
    {
        return $this->currencyRateCategory->orderBy('created_at', 'desc')->get()->pluck('name', 'id');
    }

    public function create(array $data)
    {
        $currencyRateCategory = $this->currencyRateCategory->create($data);

        return $currencyRateCategory;
    }

    public function findById($id, $columns = ['*'])
    {
        return $this->currencyRateCategory->select($columns)->findOrFail($id);
    }

    public function update(array $data, $id)
    {
        $currencyRateCategory = $this->currencyRateCategory->findOrFail($id);
        $currencyRateCategory->setOldAttributes($currencyRateCategory->getAttributes());
        $currencyRateCategory->update($data);
        event(new CurrencyRateCategoryModified($currencyRateCategory));
        return $currencyRateCategory;
    }

    public function lastLoginUpdate($id)
    {

    }

    public function destroy($id)
    {
        $currencyRateCategory = $this->currencyRateCategory->findOrFail($id);
        $currencyRateCategory->is_active = 0;
        $currencyRateCategory->save();
        return $currencyRateCategory;
    }
}