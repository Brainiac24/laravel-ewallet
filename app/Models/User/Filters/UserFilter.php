<?php
/**
 * Created by PhpStorm.
 * User: K_Hakimboev
 * Date: 25.09.2018
 * Time: 14:29
 */

namespace App\Models\User\Filters;


use App\Services\Common\Filter\QueryFilter;

class UserFilter extends QueryFilter
{
    public function fullName($value)
    {
        return $this->query->whereRaw("CONCAT_WS(' ', first_name, middle_name, last_name) LIKE ?", ["%{$value}%"]);
    }
    public function username($value)
    {
        return $this->query->whereRaw('CAST(username as CHAR(12)) LIKE ?', ["%{$value}%"]);
    }
}