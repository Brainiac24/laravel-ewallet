<?php

namespace App\Http\Controllers\Frontend\Api\CoordinatePoint;

use App\Exceptions\Frontend\Api\LogicException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\Api\CoordinatePoints\IndexCoordinatePointsRequest;
use App\Http\Resources\Frontend\Api\CoordinatePoint\CoordinatePointResource;
use App\Repositories\Frontend\CoordinatePoint\CoordinatePointRepositoryContract;
use App\Services\Common\Helpers\HttpStatusCode;

class CoordinatePointController extends Controller
{

    protected $coordinatePointRepository;

    function __construct(CoordinatePointRepositoryContract $coordinatePointRepository)
    {
        $this->coordinatePointRepository = $coordinatePointRepository;
    }

    public function index(IndexCoordinatePointsRequest $request)
    {
        $filter = $request->validated();
        $data = CoordinatePointResource::Collection($this->coordinatePointRepository->listsAll($filter));
        $code = HttpStatusCode::OK;
        //$meta = Auth::user();
        return \response()->apiSuccess(compact('code', 'data', 'meta'));
    }
}
