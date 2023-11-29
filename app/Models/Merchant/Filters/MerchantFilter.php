<?php
/**
 * Created by PhpStorm.
 * User: Ladmin
 * Date: 01.11.2019
 * Time: 13:26
 */

namespace App\Models\Merchant\Filters;


use App\Services\Common\Filter\QueryFilter;

class MerchantFilter extends QueryFilter
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

    public function organization($value)
    {
        if ($value === null) {
            return $this->query;
        } else {
            return $this->query->whereRaw('organization like ?', ["%{$value}%"]);
        }
    }

    public function parentId($value)
    {
        if ($value === null) {
            return $this->query;
        } else {
            return $this->query->whereRaw('parent_id like ?', ["%{$value}%"]);
        }
    }

    public function branchesId($value)
    {
        if ($value === null) {
            return $this->query;
        } else {
            return $this->query->whereIn('branch_id',$value);
        }
    }

    public function branchId($value)
    {
        if ($value === null) {
            return $this->query;
        } else {
            return $this->query->where('branch_id',$value);
        }
    }

    public function isVerified($value)
    {
        if ($value === null) {
            return $this->query;
        } else {
            return $this->query->where('is_verified',$value);
        }
    }

    public function fromCreatedAt($value)
    {
        if ($value == null) {
            return $this->query;
        } else {
            return $this->query->where('created_at', '>=', "{$value} 00:00:00");
        }
    }

    public function toCreatedAt($value)
    {
        if ($value == null) {
            return $this->query;
        } else {
            return $this->query->where('created_at', '<=', "{$value} 23:59:59");
        }
    }

    public function isActive($value)
    {
        if ($value === null) {
            return $this->query;
        } else {
            return $this->query->where('is_active',$value);
        }
    }

}