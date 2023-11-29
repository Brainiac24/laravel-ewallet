<?php

namespace App\Models\Area\Filters;


use App\Services\Common\Filter\QueryFilter;

class AreaFilter extends QueryFilter
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

    public function regionId($value)
    {
        if ($value === null) {
            return $this->query;
        } else {
            return $this->query->where('region_id',$value);
        }
    }

}