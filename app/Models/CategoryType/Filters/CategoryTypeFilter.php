<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 23.07.2019
 * Time: 18:07
 */

namespace App\Models\CategoryType\Filters;


use App\Services\Common\Filter\QueryFilter;

class CategoryTypeFilter extends QueryFilter
{
    public function name($value)
    {
        if ($value === null) {
            return $this->query;
        } else {
            return $this->query->whereRaw('name like ?', ["%{$value}%"]);
        }
    }

    public function code($value)
    {
        if ($value === null) {
            return $this->query;
        } else {
            return $this->query->whereRaw('code like ?', ["%{$value}%"]);
        }
    }
}