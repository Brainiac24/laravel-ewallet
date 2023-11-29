<?php

namespace App\Listeners\Backend\CoordinatePoint;

use App\Repositories\Backend\CoordinatePoint\CoordinatePointCity\CoordinatePointCityRepositoryContract;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class CoordinatePointModifiedListener
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
        $this->coordinatePointCityRepository->updateVersions([$event->entity->coordinate_point_city_id]);
    }
}
