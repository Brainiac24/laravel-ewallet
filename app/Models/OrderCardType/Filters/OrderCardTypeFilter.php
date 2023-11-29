<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 17.07.2019
 * Time: 18:12
 */

namespace App\Models\OrderCardType\Filters;


use App\Services\Common\Filter\QueryFilter;

class OrderCardTypeFilter extends QueryFilter
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

    public function codeMap($value)
    {
        if ($value === null) {
            return $this->query;
        } else {
            return $this->query->whereRaw('code_map like ?', ["%{$value}%"]);
        }
    }

    public function price($value)
    {
        if ($value === null) {
            return $this->query;
        } else {
            return $this->query->where('price', $value);
        }
    }

    public function currencyId($value)
    {
        if ($value === null) {
            return $this->query;
        } else {
            return $this->query->where('currency_id', $value);
        }
    }

    public function isActive($value)
    {
        if ($value === null) {
            return $this->query;
        } else {
            return $this->query->where('is_active', $value);
        }
    }
}