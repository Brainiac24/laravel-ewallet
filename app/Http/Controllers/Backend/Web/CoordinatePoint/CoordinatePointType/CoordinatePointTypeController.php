<?php


namespace App\Http\Controllers\Backend\Web\CoordinatePoint\CoordinatePointType;


use App\Events\Backend\User\UserHistory\UserModifiedEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Web\CoordinatePoint\CoordinatePointType\StoreCoordinatePointTypeRequest;
use App\Http\Requests\Backend\Web\CoordinatePoint\CoordinatePointType\UpdateCoordinatePointTypeRequest;
use App\Repositories\Backend\CoordinatePoint\CoordinatePointCity\CoordinatePointCityRepositoryContract;
use App\Repositories\Backend\CoordinatePoint\CoordinatePointType\CoordinatePointTypeRepositoryContract;
use App\Repositories\Backend\CoordinatePoint\CoordinatePointTypeService\CoordinatePointTypeServiceRepositoryContract;
use App\Repositories\Backend\CoordinatePoint\CoordinatePointWorkday\CoordinatePointWorkdayRepositoryContract;
use App\Services\Common\Helpers\Events;

class CoordinatePointTypeController extends Controller
{
    protected $coordinatePointTypeRepository;
    protected $coordinatePointWorkdayRepository;
    protected $coordinatePointTypeServiceRepository;
    protected $coordinatePointCityRepository;

    public function __construct(
        CoordinatePointTypeRepositoryContract $coordinatePointTypeRepository,
        CoordinatePointTypeServiceRepositoryContract $coordinatePointTypeServiceRepository,
        CoordinatePointWorkdayRepositoryContract $coordinatePointWorkdayRepository,
        CoordinatePointCityRepositoryContract $coordinatePointCityRepository
    )
    {
        $this->coordinatePointTypeRepository = $coordinatePointTypeRepository;
        $this->coordinatePointWorkdayRepository = $coordinatePointWorkdayRepository;
        $this->coordinatePointTypeServiceRepository = $coordinatePointTypeServiceRepository;
        $this->coordinatePointCityRepository = $coordinatePointCityRepository;
        $this->middleware('coordinatePointType.can-list', ['only' => ['index']]);
        $this->middleware('coordinatePointType.can-show', ['only' => ['show']]);
        $this->middleware('coordinatePointType.can-create', ['only' => ['create','store']]);
        $this->middleware('coordinatePointType.can-edit', ['only' => ['edit','update']]);
        $this->middleware('coordinatePointType.can-delete', ['only' => ['destroy']]);
    }
    public function index()
    {
        $coordinatePointTypes = $this->coordinatePointTypeRepository->paginate();
        return view('backend.coordinatepoint.coordinatePointType.index',compact('coordinatePointTypes'));
    }

    public function create()
    {
        $coordinatePointWorkdays=$this->coordinatePointWorkdayRepository
            ->all()
            ->pluck('name','id');
        return view('backend.coordinatepoint.coordinatePointType.create',
            compact('coordinatePointWorkdays'));
    }

    public function edit($id)
    {
        $coordinatePointType = $this->coordinatePointTypeRepository->findById($id);
        $coordinatePointWorkdays=$this->coordinatePointWorkdayRepository
            ->all()
            ->pluck('name','id');
        $coordinatePointCities=$this->coordinatePointCityRepository
            ->all()
            ->pluck('name','id');
        \Breadcrumbs::setCurrentRoute('admin.coordinatepointTypes.edit', $coordinatePointType);
        return view('backend.coordinatepoint.coordinatePointType.edit',
            compact('coordinatePointType', 'coordinatePointWorkdays', 'coordinatePointCities'));
    }

    public function show($id)
    {
        $coordinatePointType = $this->coordinatePointTypeRepository->findById($id);
        $coordinatePointTypeServices = $this->coordinatePointTypeServiceRepository->GetAllByTypeId($id);
        \Breadcrumbs::setCurrentRoute('admin.coordinatepointTypes.show', $coordinatePointType);
        return view('backend.coordinatepoint.coordinatePointType.show',compact('coordinatePointType','coordinatePointTypeServices'));
    }

    public function destroy($id)
    {
        $coordinatePointType = $this->coordinatePointTypeRepository->destroy($id);
        event(new UserModifiedEvent($coordinatePointType, Events::DELETED));
        session()->flash('flash_message', trans('alerts.general.success_delete'));
        return redirect()->route('admin.coordinatepointTypes.index');
    }
    public function store(StoreCoordinatePointTypeRequest $request)
    {
        $coordinatePointType = $this->coordinatePointTypeRepository->create($request->validated());
        $coordinatePointType->setChanges($coordinatePointType->getAttributes());
        event(new UserModifiedEvent($coordinatePointType, Events::CREATED));
        session()->flash('flash_message', trans('alerts.general.success_add'));
        return redirect()->route('admin.coordinatepointTypes.index');
    }
    public function update(UpdateCoordinatePointTypeRequest $request, $id)
    {
        $coordinatePointType= $this->coordinatePointTypeRepository->update($request->validated(), $id);
        event(new UserModifiedEvent($coordinatePointType, Events::UPDATED));
        session()->flash('flash_message', trans('alerts.general.success_edit'));
        return redirect()->route('admin.coordinatepointTypes.index');
    }

}