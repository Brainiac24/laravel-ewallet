<?php

namespace App\Models\Job\JobHistory\Filters;


use App\Services\Common\Filter\QueryFilter;

class JobHistoryFilter extends QueryFilter
{
    public function name($value)
    {
        if ($value === null) {
            return $this->query;
        } else {
            return $this->query->where('name', '=', $value);
        }
    }

    public function status($value)
    {
        if ($value === null) {
            return $this->query;
        } else {
            return $this->query->where('status', '=', $value);
        }
    }

    public function type($value)
    {
        if ($value === null) {
            return $this->query;
        } else {
            return $this->query->where('type', '=', $value);
        }
    }

    public function createdByUserId($value)
    {
        if ($value === null) {
            return $this->query;
        } else {
            return $this->query->where('created_by_user_id', '=', $value);
        }
    }
}