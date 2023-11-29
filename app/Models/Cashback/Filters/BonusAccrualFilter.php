<?php


namespace App\Models\Cashback\Filters;


use App\Services\Common\Filter\QueryFilter;

class BonusAccrualFilter extends QueryFilter
{
    public function fromUserFullName($value)
    {
        if ($value === null) {
            return $this->query;
        } else {
            return $this->query->whereHas('user', function ($q) use ($value) {
                $q->whereRaw("CONCAT_WS(' ', last_name, first_name, middle_name) LIKE ?", ["%{$value}%"]);
            });

        }
    }

    public function cashbackId($value)
    {
        if ($value == null) {
            return $this->query;
        } else {
            return $this->query->where('cashback_id', $value);
        }
    }

    public function bonusAccrualStatusId($value)
    {
        if ($value == null) {
            return $this->query;
        } else {
            return $this->query->where('bonus_accrual_status_id', $value);
        }
    }
}