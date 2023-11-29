<?php
/**
 * Created by PhpStorm.
 * User: K_Hakimboev
 * Date: 25.09.2018
 * Time: 14:29
 */

namespace App\Models\Currency\Filters;


use App\Services\Common\Filter\QueryFilter;

class CurrencyRateFilter extends QueryFilter
{
    public function name($value)
    {
        if($value===null){
            return $this->query;
        }else{
            return $this->query->whereHas('currency', function ($q) use ($value) {
                $q->whereRaw('name like ? ', ["%{$value}%"]);
            });
        }
    }
    public function isoName($value)
    {
    if($value===null){
        return $this->query;
    }else {
        return $this->query->whereHas('currency', function ($q) use ($value) {
            $q->whereRaw('iso_name like ? ', ["%{$value}%"]);
        });

    }
    }
    public function code($value)
    {
        if($value===null){
            return $this->query;
        }else {
            return $this->query->whereHas('currency', function ($q) use ($value) {
                $q->whereRaw('code like ? ', ["%{$value}%"]);
            });
        }
    }
}