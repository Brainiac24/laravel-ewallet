<?php

namespace App\Listeners\Backend\Cashback\CashbackItem;

use App\Models\CoordinatePoint\CoordinatePoint;
use App\Models\Merchant\Merchant;
use App\Repositories\Backend\CoordinatePoint\CoordinatePointCity\CoordinatePointCityRepositoryContract;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class CashbackItemModifiedListener
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
        $merchantIds = Merchant::where('merchant_cashback_id', $event->entity->cashback_id)
            ->orWhere('bank_cashback_id', $event->entity->cashback_id)
            ->get()->pluck('id');
        $coordinatePointCityIds = CoordinatePoint::whereIn('merchant_id', $merchantIds)
            ->get()
            ->pluck('coordinate_point_city_id');
        $this->coordinatePointCityRepository->updateVersions($coordinatePointCityIds);
    }
}
