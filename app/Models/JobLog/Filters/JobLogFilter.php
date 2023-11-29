<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 11.07.2019
 * Time: 10:59
 */

namespace App\Models\JobLog\Filters;


use App\Services\Common\Filter\QueryFilter;

class JobLogFilter extends QueryFilter
{

    public function id($value)
    {
        if ($value === null) {
            return $this->query;
        } else {
            return $this->query->where('id', '=', "$value");
        }
    }

    public function createdByUserMsisdn($value)
    {
        if ($value == null) {
            return $this->query;
        } else {
            return $this->query->whereHas('createdBy', function ($q) use ($value) {
                $q->whereRaw("msisdn LIKE ?", ["%{$value}%"]);
            });
        }
    }

    public function transactionId($value)
    {
        if ($value === null) {
            return $this->query;
        } else {
            return $this->query->where('transaction_id', '=', "$value");
        }
    }

    public function createdByUserIds(array $values = [])
    {
        if (count($values) == 0) {
            return $this->query;
        } else {
            return $this->query->whereIn('created_by_user_id', $values);
        }
    }

    public function orderId_params_json($value)
    {
        if ($value === null) {
            return $this->query;
        } else {
            return $this->query->whereRaw('params_json like ?', ["%{$value}%"]);
        }
    }

    public function orderId($value)
    {
        if ($value === null) {
            return $this->query;
        } else {
            return $this->query->where('order_id', '=', "$value");
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

    public function fromDate($value)
    {
        if ($value == null) {
            return $this->query;
        } else {
            return $this->query->where('created_at', '>=', "{$value} 00:00:00");
        }
    }

    public function toDate($value)
    {
        if ($value == null) {
            return $this->query;
        } else {
            return $this->query->where('created_at', '<=', "{$value} 23:59:59");
        }
    }

}