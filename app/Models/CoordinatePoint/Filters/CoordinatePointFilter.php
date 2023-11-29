<?php
/**
 * Created by PhpStorm.
 * User: K_Hakimboev
 * Date: 25.09.2018
 * Time: 14:29
 */

namespace App\Models\CoordinatePoint\Filters;


use App\Services\Common\Filter\QueryFilter;

class CoordinatePointFilter extends QueryFilter
{
    public function name($value)
    {
        if ($value === null) {
            return $this->query;
        } else {
            return $this->query->whereRaw('name like ?', ["%{$value}%"]);
        }
    }

    public function address($value)
    {
        if($value===null){
            return $this->query;
        }else {
            return $this->query->whereRaw('address like ?', ["%{$value}%"]);
        }
    }
    public function objt($value)
    {
        if($value===null){
            return $this->query;
        }else {
            return $this->query->where('object_type',$value);
        }
    }
    public function isActive($value)
    {
        if($value===null){
            return $this->query;
        }else {
            return $this->query->where('is_active',$value);
        }

    }

    public function coordinatePointTypeId($value)
    {
        if($value===null){
            return $this->query;
        }else {
            return $this->query->where('coordinate_point_type_id',$value);
        }
    }

    public function coordinatePointWorkdayId($value)
    {
        if($value===null){
            return $this->query;
        }else {
            return $this->query->where('coordinate_point_workday_id',$value);
        }
    }

    public function merchantId($value)
    {
        if($value===null){
            return $this->query;
        }else {
            return $this->query->where('merchant_id',$value);
        }
    }


}