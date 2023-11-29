<?php
/**
 * Created by PhpStorm.
 * User: Ladmin
 * Date: 27.09.2019
 * Time: 10:15
 */

namespace App\Models\News\Filters;


use App\Services\Common\Filter\QueryFilter;

class NewsFilter extends QueryFilter
{
    public function id($value)
    {
        if ($value === null) {
            return $this->query;
        } else {
            return $this->query->whereRaw('id like ?', ["%{$value}%"]);
        }
    }

    public function title($value)
    {
        if ($value === null) {
            return $this->query;
        } else {
            return $this->query->whereRaw('title like ?', ["%{$value}%"]);
        }
    }
}