<?php


namespace App\Models\Merchant\MerchantUser\Filters;


use App\Services\Common\Filter\QueryFilter;

class MerchantUserFilter extends QueryFilter
{
    public function id($value)
    {
        if (!empty($value)) {
            return $this->query->whereRaw('id like ?', ["%{$value}%"]);
        }
    }

    public function fullName($value)
    {
        if (!empty($value)) {
            return $this->query->whereHas('user', function ($q) use ($value) {
                $q->whereRaw("CONCAT_WS(' ', last_name, first_name, middle_name) LIKE ?", ["%{$value}%"]);
            });
        }
    }

    public function msisdn($value)
    {
        if (!empty($value)) {
            return $this->query->whereHas('user', function ($q) use ($value) {
                $q->whereRaw('msisdn like ? ', ["%{$value}%"]);
            });
        }
    }

    public function accountNumber($value)
    {
        if (!empty($value)) {
            return $this->query->whereHas('account', function ($q) use ($value) {
                $q->whereRaw('number like ? ', ["%{$value}%"])->withoutGlobalScopes();
            });
        }
    }

    public function merchantName($value)
    {
        if (!empty($value)) {
            return $this->query->whereHas('merchant', function ($q) use ($value) {
                $q->whereRaw('name like ? ', ["%{$value}%"]);
            });
        }
    }

    public function isActive($value)
    {
        if (isset($value)){
            return $this->query->where('is_active',$value);
        }
    }
}