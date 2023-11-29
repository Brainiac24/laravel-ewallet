<?php

namespace App\Listeners\Backend\CoordinatePoint\CoordinatePointWorkday;

use App\Models\CoordinatePoint\CoordiantePointType\CoordinatePointType;
use App\Models\CoordinatePoint\CoordinatePoint;
use App\Repositories\Backend\CoordinatePoint\CoordinatePointCity\CoordinatePointCityRepositoryContract;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class CoordinatePointWorkdayModifiedListener
{
    protected $coordinatePointCityRepository;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(CoordinatePointCityRepositoryContract $coordinatePointCityRepository)
    {
        $this->coordinatePointCityRepository = $coordinatePointCityRepository;
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $coordinatePointTypeIds = CoordinatePointType::where('coordinate_point_workday_id', $event->entity->id)
                ->get()
                ->pluck('id');
        $coordinatePointCityIds = CoordinatePoint::whereIn('coordinate_point_type_id', $coordinatePointTypeIds)
                ->orWhere('coordinate_point_workday_id', $event->entity->id)
                ->get()
                ->pluck('coordinate_point_city_id');
        $this->coordinatePointCityRepository->updateVersions($coordinatePointCityIds);
    }
}
