<?php

namespace App\Http\Controllers\Backend\Api\City;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Api\City\CitiesRequest;
use App\Http\Resources\Backend\Api\City\CityResource;
use App\Repositories\Backend\City\CityRepositoryContract;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public $cityRepository;

    public function __construct(CityRepositoryContract $cityRepository)
    {
        $this->cityRepository = $cityRepository;
    }

    public function citiesList(Request $request)
    {

        $cities = $this->cityRepository->all($request->search);

        $data = [
            "results" => CityResource::collection($cities),
        ];
        //dd($city);
        return \response()->apiSuccess(compact('data'));
    }

    public function cities(CitiesRequest $request)
    {

        $cities = $this->cityRepository->all(null, $request->validated());

        $data = [
            "results" => CityResource::collection($cities),
        ];

        return \response()->apiSuccess(compact('data'));
    }
}
