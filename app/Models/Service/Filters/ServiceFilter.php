<?php
/**
 * Created by PhpStorm.
 * User: K_Hakimboev
 * Date: 25.09.2018
 * Time: 14:29
 */

namespace App\Models\Service\Filters;


use App\Services\Common\Filter\QueryFilter;

class ServiceFilter extends QueryFilter
{
    protected $blackList = [];

    public function code($value)
    {
        if($value===null){
            return $this->query;
        }else {
            return $this->query->whereRaw('code like ?', ["%{$value}%"]);
        }
    }
    public function processingCode($value)
    {
        if($value===null){
            return $this->query;
        }else {
            return $this->query->whereRaw('processing_code like ?', ["%{$value}%"]);
        }
    }
    public function name($value)
    {
        if($value===null){
            return $this->query;
        }else {
            return $this->query->whereRaw('name like ?', ["%{$value}%"]);
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
    public function gatewayId($value)
    {
        if($value===null){
            return $this->query;
        }else {
            return $this->query->whereRaw('gateway_id like ?', ["%{$value}%"]);
        }
    }
    public function currencyId($value)
    {
        if($value===null){
            return $this->query;
        }else {
            return $this->query->whereRaw('currency_id like ?', ["%{$value}%"]);
        }
    }
    public function workdayId($value)
    {
        if($value===null){
            return $this->query;
        }else {
            return $this->query->whereRaw('workday_id like ?', ["%{$value}%"]);
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

    public function isCheckable($value)
    {
        if($value===null){
            return $this->query;
        }else {
            return $this->query->where('is_checkable', $value);
        }
    }

}