<?php
/**
 * Created by PhpStorm.
 * User: K_Hakimboev
 * Date: 03.10.2018
 * Time: 9:48
 */

namespace App\Models\Transaction\Filters\Frontend;


use App\Services\Common\Filter\QueryFilter;

class TransactionFilter extends QueryFilter
{
    public function dateStart($value)
    {
        return $this->query->where('created_at', '>=', "{$value} 00:00:00");
    }

    public function dateEnd($value)
    {
        return $this->query->where('created_at', '<=', "{$value} 23:59:59");
    }
}