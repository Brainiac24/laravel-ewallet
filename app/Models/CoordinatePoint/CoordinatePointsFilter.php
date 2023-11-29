<?php
/**
 * Created by PhpStorm.
 * User: K_Hakimboev
 * Date: 25.09.2018
 * Time: 14:29
 */

namespace App\Models\CoordinatePoint;


use App\Services\Common\Filter\QueryFilter;

class CoordinatePointsFilter extends QueryFilter
{
    public function objt($value)
    {
        if($value===null){
            return $this->query;
        }else {
            return $this->query->where('object_type' ,$value);
        }
    }


}