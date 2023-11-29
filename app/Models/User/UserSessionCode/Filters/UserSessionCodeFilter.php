<?php
/**
 * Created by PhpStorm.
 * User: Ladmin
 * Date: 02.09.2019
 * Time: 11:47
 */

namespace App\Models\User\UserSessionCode\Filters;


use App\Services\Common\Filter\QueryFilter;

class UserSessionCodeFilter extends QueryFilter
{
    public function id($value)
    {
        if ($value === null) {
            return $this->query;
        } else {
            return $this->query->whereRaw('id like ?', ["%{$value}%"]);
        }
    }


    public function value($value)
    {
        if ($value === null) {
            return $this->query;
        } else {
            return $this->query->whereRaw('value like ?', ["%{$value}%"]);
        }
    }

    public function userSessionCodeTypeId($value)
    {
        if (!empty($value)) {
            return $this->query->where('user_session_code_type_id', $value);
        }
    }


}