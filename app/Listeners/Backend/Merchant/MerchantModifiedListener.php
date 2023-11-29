<?php

namespace App\Listeners\Backend\Merchant;

use App\Models\CoordinatePoint\CoordinatePoint;
use App\Repositories\Backend\CoordinatePoint\CoordinatePointCity\CoordinatePointCityRepositoryContract;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class MerchantModifiedListener
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

        $coordinatePointCityIds = CoordinatePoint::where('merchant_id', $event->entity->id)
            ->get()
            ->pluck('coordinate_point_city_id');
        $this->coordinatePointCityRepository->updateVersions($coordinatePointCityIds);
    }
}
