<?php

namespace App\Http\Controllers\backend\web\area;


use App\Events\Backend\User\UserHistory\UserModifiedEvent;
use App\Http\Requests\Backend\Web\Area\StoreAreaRequest;
use App\Http\Requests\Backend\Web\Area\UpdateAreaRequest;
use App\Repositories\Backend\Area\AreaRepositoryContract;
use App\Repositories\Backend\Country\CountryRepositoryContract;
use App\Repositories\Backend\Region\RegionRepositoryContract;
use App\Services\Common\Helpers\Events;
use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AreaController extends Controller
{
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
     * @param AreaRepositoryContract $areaRepositoryContract
     * @param RegionRepositoryContract $regionRepositoryContract
     * @param CountryRepositoryContract $countryRepositoryContract
     */

    public function __construct(AreaRepositoryContract $areaRepositoryContract, RegionRepositoryContract $regionRepositoryContract, CountryRepositoryContract $countryRepositoryContract)
    {
        $this->areaRepositoryContract = $areaRepositoryContract;
        $this->regionRepositoryContract = $regionRepositoryContract;
        $this->countryRepositoryContract = $countryRepositoryContract;

        $this->middleware('area.can-list', ['only' => ['index']]);
        $this->middleware('area.can-show', ['only' => ['show']]);
        $this->middleware('area.can-create', ['only' => ['create','store']]);
        $this->middleware('area.can-edit', ['only' => ['edit','update']]);
        $this->middleware('area.can-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        //
        $areas = $this->areaRepositoryContract->getAllWithRegion();
        //dd($areas);
        return view('backend.area.index', compact('areas'));
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
        return view('backend.area.create',compact('country'));
    }

    public function getByRegionId(Request $request)
    {
        if($request->ajax())
        {
            $data = $this->areaRepositoryContract->getAreasByRegionId($request->region_id);
            $data = view('backend.area.ajax-select', compact('data'))->render();
            return response()->json(['options'=>$data]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAreaRequest $request)
    {
        //
        $area = $this->areaRepositoryContract->create($request->validated());
        $area->setChanges($area->getAttributes());
        event(new UserModifiedEvent($area, Events::CREATED));
        session()->flash('flash_message', trans('alerts.general.success_add'));
        return redirect()->route('admin.areas.index');
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
        $area= $this->areaRepositoryContract->getByIdWithRegion($id);

        //dd($area);
        Breadcrumbs::setCurrentRoute('admin.areas.show', $area);
        return view('backend.area.show', compact('area'));
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
        $area = $this->areaRepositoryContract->getByIdWithRegion($id);
        $region = $this->regionRepositoryContract->all('')->pluck('name','id');
        $selectedRegion = $area->region_id;

        $country = $this->countryRepositoryContract->all('')->pluck('name','id');

        $regionCountry = $this->areaRepositoryContract->getByRegionIdWithCountry($area->region_id);
        $selectedCountry = $regionCountry->country->id;

        //dd($country);
        Breadcrumbs::setCurrentRoute('admin.areas.edit', $area);
        return view('backend.area.edit', compact('area','region', 'selectedRegion','country','selectedCountry'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAreaRequest $request, $id)
    {
        //
//        dd($request);
        $area = $this->areaRepositoryContract->update($request->validated(), $id);
        event(new UserModifiedEvent($area, Events::UPDATED));
        session()->flash('flash_message', trans('alerts.general.success_edit'));
        return redirect()->route('admin.areas.index');
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
            $area = $this->areaRepositoryContract->destroy($id);
            event(new UserModifiedEvent($area, Events::DELETED));
            session()->flash('flash_message', trans('alerts.general.success_disable'));
            return redirect()->route('admin.areas.index');
        } catch (\Exception $e) {
            session()->flash('flash_message_error', trans('errorMessages.errors.try_errors.' . $e->getCode()));
            return redirect()->route('admin.$areas.index');
        }
    }
}
