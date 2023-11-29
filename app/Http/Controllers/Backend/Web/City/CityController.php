<?php

namespace App\Http\Controllers\Backend\web\city;

use App\Http\Requests\Backend\Web\City\IndexCityRequest;
use App\Events\Backend\User\UserHistory\UserModifiedEvent;
use App\Http\Requests\Backend\Web\City\StoreCityRequest;
use App\Http\Requests\Backend\Web\City\UpdateCityRequest;
use App\Repositories\Backend\Area\AreaRepositoryContract;
use App\Repositories\Backend\City\CityRepositoryContract;
use App\Repositories\Backend\Country\CountryRepositoryContract;
use App\Repositories\Backend\Region\RegionRepositoryContract;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Common\Helpers\Events;
use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;

class CityController extends Controller
{
    /**
     * @var CityRepositoryContract
     */
    private $cityRepositoryContract;
    /**
     * @var AreaRepositoryContract
     */
    private $areaRepositoryContract;
    /**
     * @var RegionRepositoryContract
     */
    private $regionRepositoryContract;
    /**
     * @var CountryRepositoryContract
     */
    private $countryRepositoryContract;

    /**
     * Display a listing of the resource.
     *
     * @param CityRepositoryContract $cityRepositoryContract
     * @param AreaRepositoryContract $areaRepositoryContract
     * @param RegionRepositoryContract $regionRepositoryContract
     * @param CountryRepositoryContract $countryRepositoryContract
     */
    public function __construct(CityRepositoryContract $cityRepositoryContract, AreaRepositoryContract $areaRepositoryContract,  RegionRepositoryContract $regionRepositoryContract, CountryRepositoryContract $countryRepositoryContract)
    {
        $this->cityRepositoryContract = $cityRepositoryContract;
        $this->areaRepositoryContract = $areaRepositoryContract;
        $this->regionRepositoryContract = $regionRepositoryContract;
        $this->countryRepositoryContract = $countryRepositoryContract;

        $this->middleware('city.can-list', ['only' => ['index']]);
        $this->middleware('city.can-show', ['only' => ['show']]);
        $this->middleware('city.can-create', ['only' => ['create','store']]);
        $this->middleware('city.can-edit', ['only' => ['edit','update']]);
        $this->middleware('city.can-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        //
       // $data = $request->validated();
        $cities = $this->cityRepositoryContract->getWithRelation();
       //dd($cities);
//        $cities = $this->cityRepositoryContract->paginate($data);
        return view('backend.city.index', compact('cities'));
    }

    public function getByAreaId(Request $request)
    {
        if ($request->ajax()) {
            $data = $this->cityRepositoryContract->getCitiesByAreaId($request->area_id);
            $data = view('backend.area.ajax-select', compact('data'))->render();
            return response()->json(['options' => $data]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $country = $this->countryRepositoryContract->all('')->pluck('name','id');
        return view('backend.city.create',compact('country'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCityRequest $request)
    {
        //
        $city = $this->cityRepositoryContract->create($request->validated());
        $city->setChanges($city->getAttributes());
        event(new UserModifiedEvent($city, Events::CREATED));
        session()->flash('flash_message', trans('alerts.general.success_add'));
        return redirect()->route('admin.city.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $city=$this->cityRepositoryContract->getByIdWithRelation($id);

        Breadcrumbs::setCurrentRoute('admin.city.show', $city);
        return view('backend.city.show', compact('city'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $city = $this->cityRepositoryContract->getByIdWithRelation($id);

        $area = $this->areaRepositoryContract->getAreasByRegionId($city->area->region_id);
        $selectedArea = $city->area_id;

        //dd($area);

        $region = $this->regionRepositoryContract->getById($city->area->region_id)->pluck('name', 'id');
        $selectedRegion = $city->area->region_id;

        $country = $this->countryRepositoryContract->all('')->pluck('name', 'id');
        $selectedCountry = $city->area->region->country_id;
        //dd($selectedCountry);
        Breadcrumbs::setCurrentRoute('admin.city.edit', $city);
        return view('backend.city.edit', compact('city','area', 'selectedArea','region','selectedRegion','country','selectedCountry'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCityRequest $request, $id)
    {
        //
        $area = $this->cityRepositoryContract->update($request->validated(), $id);
        event(new UserModifiedEvent($area, Events::UPDATED));
        session()->flash('flash_message', trans('alerts.general.success_edit'));
        return redirect()->route('admin.city.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        try {
            $area = $this->cityRepositoryContract->destroy($id);
            event(new UserModifiedEvent($area, Events::DELETED));
            session()->flash('flash_message', trans('alerts.general.success_disable'));
            return redirect()->route('admin.city.index');
        } catch (\Exception $e) {
            session()->flash('flash_message_error', trans('errorMessages.errors.try_errors.' . $e->getCode()));
            return redirect()->route('admin.city.index');
        }
    }
}
