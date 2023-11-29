<?php
/**
 * Created by PhpStorm.
 * User: Ladmin
 * Date: 28.08.2019
 * Time: 17:13
 */

namespace App\Models\User\UserServiceLimit\Filters;


use App\Services\Common\Filter\QueryFilter;

class UserServiceLimitFilter extends QueryFilter
{
    public function id($value)
    {
        if ($value === null) {
            return $this->query;
        } else {
            return $this->query->whereRaw('id like ?', ["%{$value}%"]);
        }
    }

    public function userId($value)
    {
        if (!empty($value)) {
            return $this->query->whereHas('user', function ($q) use ($value) {
                $q->whereRaw('msisdn like ? ', ["%{$value}%"]);
            });
        }
    }

    public function serviceId($value)
    {
        if($value===null){
            return $this->query;
        }else {
            return $this->query->whereRaw('name like ?', ["%{$value}%"]);
        }
    }
}