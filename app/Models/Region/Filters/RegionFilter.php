<?php

namespace App\Models\Region\Filters;


use App\Services\Common\Filter\QueryFilter;

class RegionFilter extends QueryFilter
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

    public function countryId($value)
    {
        if ($value === null) {
            return $this->query;
        } else {
            return $this->query->where('country_id',$value);
        }
    }

}