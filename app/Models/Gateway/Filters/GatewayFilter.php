<?php
/**
 * Created by PhpStorm.
 * User: K_Hakimboev
 * Date: 25.09.2018
 * Time: 14:29
 */

namespace App\Models\Gateway\Filters;


use App\Services\Common\Filter\QueryFilter;

class GatewayFilter extends QueryFilter
{
    public function gatewayName($value)
    {
        if($value===null){
            return $this->query;
        }else {
            return $this->query->whereRaw('name like ?', ["%{$value}%"]);
        }
    }
    public function code($value)
    {
        if($value===null){
            return $this->query;
        }else {
            return $this->query->whereRaw('code like ?', ["%{$value}%"]);
        }
    }
    public function paramsJson($value)
    {
        if($value===null){
            return $this->query;
        }else {
            return $this->query->whereRaw('params_json like ?', ["%{$value}%"]);
        }
    }
    public function isActive($value)
    {
        if($value===null){
            return $this->query;
        }else {
            return $this->query->where('is_active', $value);
        }
    }
    public function isEnabledForAccount($value)
    {
        if($value===null){
            return $this->query;
        }else {
            return $this->query->where('is_enabled_for_account', $value);
        }
    }
    public function isEnabledForService($value)
    {
        if($value===null){
            return $this->query;
        }else {
            return $this->query->where('is_enabled_for_service', $value);
        }
    }

}