<?php

namespace App\Models\City\Filters;


use App\Services\Common\Filter\QueryFilter;

class CityFilter extends QueryFilter
{
    public function id($value)
    {
        if ($value === null) {
            return $this->query;
        } else {
            return $this->query->whereRaw('id like ?', ["%{$value}%"]);
        }
    }

    public function name($value)
    {
        if ($value === null) {
            return $this->query;
        } else {
            return $this->query->whereRaw('name like ?', ["%{$value}%"]);
        }
    }

    public function areaId($value)
    {
        if ($value === null) {
            return $this->query;
        } else {
            return $this->query->where('area_id', $value);
        }
    }

}