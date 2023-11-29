<?php

namespace App\Http\Controllers\Backend\Api\Region;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Api\Region\RegionsRequest;
use App\Http\Resources\Backend\Api\Region\RegionResource;
use App\Repositories\Backend\Region\RegionRepositoryContract;
use Illuminate\Http\Request;

class RegionController extends Controller
{
    public $regionRepository;

    public function __construct(RegionRepositoryContract $regionRepository)
    {
        $this->regionRepository = $regionRepository;
    }

    public function regionsList(Request $request)
    {

        $regions = $this->regionRepository->all($request->search);

        $data = [
            "results" => RegionResource::collection($regions),
        ];
        //dd($city);
        return \response()->apiSuccess(compact('data'));
    }

    public function regions(RegionsRequest $request)
    {

        $regions = $this->regionRepository->all(null, $request->validated());

        $data = [
            "results" => RegionResource::collection($regions),
        ];
        //dd($city);
        return \response()->apiSuccess(compact('data'));
    }
}
