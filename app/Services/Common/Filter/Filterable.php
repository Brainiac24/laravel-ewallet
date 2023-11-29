<?php
/**
 * Created by PhpStorm.
 * User: K_Hakimboev
 * Date: 25.09.2018
 * Time: 13:11
 */

namespace App\Services\Common\Filter;


trait Filterable
{
    public function scopeFilterBy($query, QueryFilter $queryFilter)
    {
        return $queryFilter->apply($query);
    }
}