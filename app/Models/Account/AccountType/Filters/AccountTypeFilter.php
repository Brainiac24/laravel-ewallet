<?php
/**
 * Created by PhpStorm.
 * User: Ladmin
 * Date: 06.09.2019
 * Time: 10:02
 */

namespace App\Models\Account\AccountType\Filters;


use App\Services\Common\Filter\QueryFilter;

class AccountTypeFilter extends QueryFilter
{
    public function name($value)
    {
        if (empty($value)) {
            return $this->query;
        }else {
            return $this->query->whereRaw('name like ?', ["%{$value}%"]);
        }
    }

    public function codeMap($value)
    {
        if (empty($value)) {
            return $this->query;
        }else {
            return $this->query->whereRaw('code_map like ?', ["%{$value}%"]);
        }
    }
}