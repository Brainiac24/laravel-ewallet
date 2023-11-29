<?php
/**
 * Created by PhpStorm.
 * User: K_Hakimboev
 * Date: 25.09.2018
 * Time: 14:29
 */

namespace App\Models\Account\Filters;


use App\Services\Common\Filter\QueryFilter;

class AccountFilter extends QueryFilter
{
    protected $blackList = [];

    public function number($value)
    {
        if (empty($value)) {
            return $this->query;
        }else {
            return $this->query->whereRaw('number like ?', ["%{$value}%"]);
        }
    }

    public function fullName($value)
    {
        if (!empty($value)) {
            return $this->query->whereHas('user', function ($q) use ($value) {
                $q->whereRaw("CONCAT_WS(' ', last_name, first_name, middle_name) LIKE ?", ["%{$value}%"]);
            });
        }
        return $this->query;
    }

    public function msisdn($value)
    {
        if (!empty($value)) {
            return $this->query->whereHas('user', function ($q) use ($value) {
                $q->whereRaw('msisdn like ? ', ["%{$value}%"]);
            });
        }
        return $this->query;
    }

    public function accountTypeId($value)
    {
        if (!empty($value)) {
            return $this->query->where('account_type_id', $value);
        }
        return $this->query;
    }

    public function accountStatusId($value)
    {
        if (!empty($value)) {
            return $this->query->where('account_status_id', $value);
        }
        return $this->query;
    }

    public function currencyId($value)
    {
        if (!empty($value)) {
            return $this->query->where('currency_id', $value);
        }
        return $this->query;
    }

}