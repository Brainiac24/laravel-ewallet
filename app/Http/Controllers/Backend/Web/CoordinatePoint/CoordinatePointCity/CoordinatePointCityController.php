<?php


namespace App\Http\Controllers\Backend\Web\CoordinatePoint\CoordinatePointCity;


use App\Events\Backend\User\UserHistory\UserModifiedEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Web\CoordinatePoint\CoordinatePointCity\StoreCoordiantePointCityRequest;
use App\Http\Requests\Backend\Web\CoordinatePoint\CoordinatePointCity\UpdateCoordiantePointCityRequest;
use App\Repositories\Backend\City\CityRepositoryContract;
use App\Repositories\Backend\CoordinatePoint\CoordinatePointCity\CoordinatePointCityRepositoryContract;
use App\Services\Common\Helpers\Events;

class CoordinatePointCityController extends Controller
{
    protected $coordinatePointCityRepository;
    protected $cityRepository;

    public function __construct(CoordinatePointCityRepositoryContract $coordinatePointCityRepository,
            CityRepositoryContract $cityRepository
        )
    {
        $this->coordinatePointCityRepository = $coordinatePointCityRepository;
        $this->cityRepository = $cityRepository;
        $this->middleware('coordinatePointCity.can-list', ['only' => ['index']]);
        $this->middleware('coordinatePointCity.can-show', ['only' => ['show']]);
        $this->middleware('coordinatePointCity.can-create', ['only' => ['create','store']]);
        $this->middleware('coordinatePointCity.can-edit', ['only' => ['edit','update']]);
        $this->middleware('coordinatePointCity.can-delete', ['only' => ['destroy']]);
    }
    public function index()
    {
        $coordinatePointCities = $this->coordinatePointCityRepository->paginate();
        return view('backend.coordinatepoint.coordinatePointCity.index',compact('coordinatePointCities'));
    }
    public function create()
    {
        $cities = $this->cityRepository->all('')->prepend('', '')->pluck('name', 'id');
        return view('backend.coordinatepoint.coordinatePointCity.create', compact('cities'));
    }

    public function edit($id)
    {
        $coordinatePointCity = $this->coordinatePointCityRepository->findById($id);
        $cities = $this->cityRepository->all('')->prepend('', '')->pluck('name', 'id');
        \Breadcrumbs::setCurrentRoute('admin.coordinatePointCities.edit', $coordinatePointCity);
        return view('backend.coordinatepoint.coordinatePointCity.edit',compact('coordinatePointCity', 'cities'));
    }

    public function show($id)
    {
        $coordinatePointCity = $this->coordinatePointCityRepository->findById($id);
        \Breadcrumbs::setCurrentRoute('admin.coordinatePointCities.show', $coordinatePointCity);
        return view('backend.coordinatepoint.coordinatePointCity.show',compact('coordinatePointCity'));
    }

    public function destroy($id)
    {
        $coordinatePointCity = $this->coordinatePointCityRepository->destroy($id);
        event(new UserModifiedEvent($coordinatePointCity, Events::DELETED));
        session()->flash('flash_message', trans('alerts.general.success_delete'));
        return redirect()->route('admin.coordinatePointCities.index');
    }
    public function store(StoreCoordiantePointCityRequest $request)
    {
        $coordinatePointCity = $this->coordinatePointCityRepository->create($request->validated());
        $coordinatePointCity->setChanges($coordinatePointCity->getAttributes());
        event(new UserModifiedEvent($coordinatePointCity, Events::CREATED));
        session()->flash('flash_message', trans('alerts.general.success_add'));
        return redirect()->route('admin.coordinatePointCities.index');
    }
    public function update(UpdateCoordiantePointCityRequest $request, $id)
    {
        $coordinatePointCity= $this->coordinatePointCityRepository->update($request->validated(), $id);
        event(new UserModifiedEvent($coordinatePointCity, Events::UPDATED));
        session()->flash('flash_message', trans('alerts.general.success_edit'));
        return redirect()->route('admin.coordinatePointCities.index');
    }
}