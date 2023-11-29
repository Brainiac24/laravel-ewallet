<?php
/**
 * Created by PhpStorm.
 * User: Ladmin
 * Date: 23.08.2019
 * Time: 10:28
 */

namespace App\Models\Purpose\Filters;


use App\Services\Common\Filter\QueryFilter;

class PurposeFilter extends QueryFilter
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

    public function name($value)
    {
        if ($value === null) {
            return $this->query;
        } else {
            return $this->query->whereRaw('name like ?', ["%{$value}%"]);
        }
    }
}