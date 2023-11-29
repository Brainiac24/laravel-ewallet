<?php
/**
 * Created by PhpStorm.
 * User: F_Kosimov
 * Date: 18.07.2018
 * Time: 15:10
 */

namespace App\Repositories\Frontend\CoordinatePoint;

use App\Models\CoordinatePoint\CoordinatePoint;
use App\Models\CoordinatePoint\CoordinatePointsFilter;

class CoordinatePointEloquentRepository implements CoordinatePointRepositoryContract
{
    protected $coordinatePointRepository;

    public function __construct(CoordinatePoint $coordinatePointRepository)
    {
        $this->coordinatePointRepository = $coordinatePointRepository;
    }

    public function listsAll($filter=[])
    {
        return $this->coordinatePointRepository->select()->filterBy(new CoordinatePointsFilter($filter))->where('is_active', 1)->get();
    }


}