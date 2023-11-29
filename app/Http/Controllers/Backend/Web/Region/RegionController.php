<?php

namespace App\Http\Controllers\Backend\web\region;

use App\Events\Backend\User\UserHistory\UserModifiedEvent;
use App\Http\Requests\Backend\Web\Region\StoreRegionRequest;
use App\Http\Requests\Backend\Web\Region\UpdateRegionRequest;
use App\Repositories\Backend\Country\CountryRepositoryContract;
use App\Repositories\Backend\Region\RegionRepositoryContract;
use App\Services\Common\Helpers\Events;
use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RegionController extends Controller
{
    /**
     * @var RegionRepositoryContract
     */
    private $regionRepositoryContract;
    /**
     * @var CountryRepositoryContract
     */
    private $countryRepositoryContract;

    /**
     * RegionController constructor.
     * @param RegionRepositoryContract $regionRepositoryContract
     * @param CountryRepositoryContract $countryRepositoryContract
     */
    public function __construct(RegionRepositoryContract $regionRepositoryContract, CountryRepositoryContract $countryRepositoryContract)
    {
        $this->regionRepositoryContract = $regionRepositoryContract;
        $this->countryRepositoryContract = $countryRepositoryContract;

        $this->middleware('region.can-list', ['only' => ['index']]);
        $this->middleware('region.can-show', ['only' => ['show']]);
        $this->middleware('region.can-create', ['only' => ['create','store']]);
        $this->middleware('region.can-edit', ['only' => ['edit','update']]);
        $this->middleware('region.can-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $regions = $this->regionRepositoryContract->getAllWithCountry();
       // dd($regions);
        return view('backend.region.index', compact('regions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $country = $this->countryRepositoryContract->all('')->pluck('name','id');;
        return view('backend.region.create',compact('country'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRegionRequest $request)
    {
        $region = $this->regionRepositoryContract->create($request->validated());
        $region->setChanges($region->getAttributes());
        event(new UserModifiedEvent($region, Events::CREATED));
        session()->flash('flash_message', trans('alerts.general.success_add'));
        return redirect()->route('admin.regions.index');
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
        $region = $this->regionRepositoryContract->getByIdWithCountry($id);
        Breadcrumbs::setCurrentRoute('admin.regions.show', $region);
        return view('backend.region.show', compact('region'));
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
        $region = $this->regionRepositoryContract->getByIdWithCountry($id);//->pluck('name','id');
        $country = $this->countryRepositoryContract->all('')->pluck('name','id');
        $selectedCountry = $region->country_id;
        //dd($selectedCountry);

        Breadcrumbs::setCurrentRoute('admin.regions.edit', $region);
        return view('backend.region.edit', compact('region','country', 'selectedCountry'));
    }

    public function getByCountyId(Request $request)
    {
        if($request->ajax()){

            $data = $this->regionRepositoryContract->getRegionsByCountyId($request->country_id);

            //dd($region);
            $data = view('backend.area.ajax-select',compact('data'))->render();

            //dd($data);
            return response()->json(['options'=>$data]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRegionRequest $request, $id)
    {
        //dd($request->all());
        $region = $this->regionRepositoryContract->update($request->validated(), $id);
        event(new UserModifiedEvent($region, Events::UPDATED));
        session()->flash('flash_message', trans('alerts.general.success_edit'));
        return redirect()->route('admin.regions.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $region = $this->regionRepositoryContract->destroy($id);
            event(new UserModifiedEvent($region, Events::DELETED));
            session()->flash('flash_message', trans('alerts.general.success_disable'));
            return redirect()->route('admin.regions.index');
        } catch (\Exception $e) {
            session()->flash('flash_message_error', trans('errorMessages.errors.try_errors.' . $e->getCode()));
            return redirect()->route('admin.regions.index');
        }
    }
}
