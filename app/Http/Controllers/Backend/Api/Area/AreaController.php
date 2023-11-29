<?php

namespace App\Http\Controllers\Backend\Api\Area;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Api\Area\AreasRequest;
use App\Http\Resources\Backend\Api\Area\AreaResource;
use App\Repositories\Backend\Area\AreaRepositoryContract;
use Illuminate\Http\Request;

class AreaController extends Controller
{
    public $areaRepository;

    public function __construct(AreaRepositoryContract $areaRepository)
    {
        $this->areaRepository = $areaRepository;
    }

    public function areasList(Request $request)
    {

        $areas = $this->areaRepository->all($request->search);

        $data = [
            "results" => AreaResource::collection($areas),
        ];
        //dd($city);
        return \response()->apiSuccess(compact('data'));
    }

    public function areas(AreasRequest $request)
    {
        $areas = $this->areaRepository->all(null, $request->validated());

        $data = [
            "results" => AreaResource::collection($areas),
        ];

        return \response()->apiSuccess(compact('data'));
    }
}
