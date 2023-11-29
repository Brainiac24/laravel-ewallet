<?php
/**
 * Created by PhpStorm.
 * User: Ladmin
 * Date: 04.11.2019
 * Time: 14:00
 */

namespace App\Models\Merchant\MerchantItem\Filters;


use App\Services\Common\Filter\QueryFilter;

class MerchantItemFilter extends QueryFilter
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

    public function parentId($value)
    {
        if ($value === null) {
            return $this->query;
        } else {
            return $this->query->whereRaw('merchant_id like ?', ["%{$value}%"]);
        }
    }
}