<?php

namespace App\Http\Controllers\Backend\Api\Country;

use App\Http\Controllers\Controller;
use App\Http\Resources\Backend\Api\Country\CountryResource;
use App\Repositories\Backend\Country\CountryRepositoryContract;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    public $countryRepository;

    public function __construct(CountryRepositoryContract $countryRepository)
    {
        $this->countryRepository = $countryRepository;
    }

    public function countriesList(Request $request)
    {

        $countries = $this->countryRepository->all($request->search);

        $data = [
            "results" => CountryResource::collection($countries),
        ];
        //dd($city);
        return \response()->apiSuccess(compact('data'));
    }

    public function countriesListTajikistan()
    {
        $id = '3d9a3544-9791-4a98-9dc8-89527763776d';
        $countries = $this->countryRepository->getById($id);
        //dd($countries);

        $data = [
            "results" => CountryResource::collection($countries),
        ];
        //dd($city);
        return \response()->apiSuccess(compact('data'));
    }
}
