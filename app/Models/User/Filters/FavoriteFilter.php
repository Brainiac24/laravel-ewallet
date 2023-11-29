<?php
/**
 * Created by PhpStorm.
 * User: K_Hakimboev
 * Date: 25.09.2018
 * Time: 14:29
 */

namespace App\Models\User\Filters;


use App\Services\Common\Filter\QueryFilter;

class FavoriteFilter extends QueryFilter
{
    public function paramsJson($value)
    {
        return $this->query->whereRaw('params_json LIKE ?', ["%{$value}%"]);
    }
    public function msisdn($value)
    {
        if($value===null){
            return $this->query;
        }else{
            return $this->query->whereHas('user', function ($q) use ($value) {
                $q->whereRaw("msisdn LIKE ?", ["%{$value}%"]);
            });
        }
    }
}