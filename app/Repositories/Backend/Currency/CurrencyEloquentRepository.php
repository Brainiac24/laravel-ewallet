<?php
/**
 * Created by PhpStorm.
 * User: F_Kosimov
 * Date: 18.07.2018
 * Time: 15:10
 */

namespace App\Repositories\Backend\Currency;

use App\Models\Currency\Currency;


class CurrencyEloquentRepository implements CurrencyRepositoryContract
{
    protected $currency;

    public function __construct(Currency $currency)
    {

        $this->currency = $currency;

    }

    public function getForDataTable()
    {

    }

    public function all($columns = ['*'])
    {
        return $this->currency::get($columns);;
    }

    public function allExceptTJS($columns = ['*'])
    {
        $currency = $this->currency->where('id', '!=', config('app_settings.currency_id_tjs'))->get($columns);
        return $currency;
    }

    public function paginate($perPage = 30, $columns = ['*'])
    {
        return $this->currency->select($columns)->orderBy('created_at', 'desc')->paginate($perPage);
    }

    public function listsAll()
    {
        return $this->currency->orderBy('created_at', 'desc')->get()->pluck('name', 'id');
    }

    public function create(array $data)
    {
        return $this->currency->create($data);
    }

    public function findById($id, $columns = ['*'])
    {
        return $this->currency->select($columns)->findOrFail($id);
    }

    public function findByCode($code, $columns = ['*'])
    {
        return $this->currency->select($columns)->where('code',$code)->first();
    }

    public function update(array $data, $id)
    {
        $currency = $this->currency->findOrFail($id);
        $currency->setOldAttributes($currency->getAttributes());
        $currency->update($data);
        return $currency;
    }

    public function lastLoginUpdate($id)
    {

    }

    public function destroy($id)
    {
        $currency = $this->currency->findOrFail($id);
        $currency->is_active = 0;
        $currency->save();
        return $currency;
    }
}