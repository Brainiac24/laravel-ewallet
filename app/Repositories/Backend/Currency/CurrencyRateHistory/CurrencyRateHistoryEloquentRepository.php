<?php
/**
 * Created by PhpStorm.
 * User: F_Kosimov
 * Date: 18.07.2018
 * Time: 15:10
 */

namespace App\Repositories\Backend\Currency\CurrencyRateHistory;


use App\Models\Currency\CurrencyRateHistory\CurrencyRateHistory;


class CurrencyRateHistoryEloquentRepository implements CurrencyRateHistoryRepositoryContract
{
    protected $currencyRate;

    public function __construct(CurrencyRateHistory $currencyRate)
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

    public function paginate($perPage = 30, $columns = ['*'])
    {
        return $this->currencyRate->select($columns)->with('currency')->orderBy('created_at', 'desc')->paginate($perPage);
    }
    public function paginateByCurrencyID($id = null,$perPage = 30, $columns = ['*'])
    {
        return $this->currencyRate->select($columns)->where('currency_id',$id)->with('currency')->orderBy('created_at', 'desc')->paginate($perPage);
    }

    public function listsAll()
    {
        return $this->currencyRate->orderBy('created_at', 'desc')->get()->pluck('name', 'id');
    }

    public function create(array $data)
    {
        return $this->currencyRate->create($data);
    }

    public function findById($id, $columns = ['*'])
    {
        return $this->currencyRate->select($columns)->findOrFail($id);
    }

    public function update(array $data, $id)
    {
        $currencyRate = $this->currencyRate->findOrFail($id);
        $currencyRate->update($data);
    }

    public function lastLoginUpdate($id)
    {

    }

    public function destroy($id)
    {
        $currencyRate = $this->currencyRate->findOrFail($id);
        $currencyRate->is_active = 0;
        $currencyRate->save();
    }
}