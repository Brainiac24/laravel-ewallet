<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 17.07.2019
 * Time: 18:12
 */

namespace App\Models\Bank\Filters;


use App\Services\Common\Filter\QueryFilter;

class BankFilter extends QueryFilter
{
    public function id($value)
    {
        if ($value === null) {
            return $this->query;
        }

        return $this->query->whereRaw('id like ?', ["%{$value}%"]);

    }

    public function name($value)
    {
        if ($value === null) {
            return $this->query;
        }

        return $this->query->whereRaw('name like ?', ["%{$value}%"]);

    }

    public function code($value)
    {
        if (strlen($value)) {
            return $this->query->whereRaw('code like ?', ["%{$value}%"]);
        }

        return $this->query;
    }

    public function codeMap($value)
    {
        if (!is_null($value)) {
            return $this->query->whereRaw('code_map like ?', ["%{$value}%"]);
        }

        return $this->query;
    }

    public function bic($value)
    {
        if (!is_null($value)) {
            return $this->query->whereRaw('bic like ?', ["%{$value}%"]);
        }

        return $this->query;
    }

    public function corrAcc($value)
    {
        if (!is_null($value)) {
            return $this->query->whereRaw('corr_acc like ?', ["%{$value}%"]);
        }

        return $this->query;
    }

    public function isActive($value)
    {
        if (!is_null($value)) {
            return $this->query->where('is_active', $value);
        }

        return $this->query;
    }

    public function createdAt($value)
    {
        if (!is_null($value)) {
            return $this->query->whereRaw('created_at like ?', ["{$value}%"]);
        }

        return $this->query;
    }
}