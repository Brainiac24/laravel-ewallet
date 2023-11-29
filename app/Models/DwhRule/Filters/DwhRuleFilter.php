<?php
/**
 * Created by PhpStorm.
 * User: Nabijon
 * Date: 01.09.2021
 * Time: 10:43
 */

namespace App\Models\DwhRule\Filters;


use App\Services\Common\Filter\QueryFilter;

class DwhRuleFilter extends QueryFilter
{
    public function table($value)
    {
        if($value){
            return $this->query->where('table', $value);
        }

        return $this->query;

    }

    public function description($value)
    {
        if($value){
            return $this->query->where('description','like',  "%{$value}%");
        }

        return $this->query;

    }

    public function jobLogType($value)
    {
        if($value || $value==='0'){
            return $this->query->where('job_log_type', $value);
        }

        return $this->query;

    }

    public function toDwhDays($value)
    {
        if($value){
            return $this->query->where('to_dwh_days', $value);
        }

        return $this->query;

    }

    public function deleteFromDwhDays($value)
    {
        if($value){
            return $this->query->where('delete_from_dwh_days', $value);
        }

        return $this->query;

    }
}