<?php
/**
 * Created by PhpStorm.
 * User: Ladmin
 * Date: 23.08.2019
 * Time: 14:35
 */

namespace App\Models\TempUser\Filters;


use App\Services\Common\Filter\QueryFilter;

class TempUserFilter extends QueryFilter
{
    public function id($value)
    {
        if ($value === null) {
            return $this->query;
        } else {
            return $this->query->whereRaw('id like ?', ["%{$value}%"]);
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

    public function fullName($value)
    {
        return $this->query->whereRaw("CONCAT_WS(' ', last_name, first_name, middle_name) LIKE ?", ["%{$value}%"]);
    }

    public function msisdn($value)
    {
        return $this->query->whereRaw('CAST(msisdn as CHAR(12)) LIKE ?', ["%{$value}%"]);
    }
}