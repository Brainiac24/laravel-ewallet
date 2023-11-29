<?php


namespace App\Http\Controllers\Backend\Web\CoordinatePoint\CoordinatePointTypeService;


use App\Events\Backend\User\UserHistory\UserModifiedEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Web\CoordinatePoint\CoordinatePointTypeService\StoreCoordinatePointTypeServiceRequest;
use App\Http\Requests\Backend\Web\CoordinatePoint\CoordinatePointTypeService\UpdateCoordinatePointTypeServiceRequest;
use App\Repositories\Backend\CoordinatePoint\CoordinatePointService\CoordinatePointServiceRepositoryContract;
use App\Repositories\Backend\CoordinatePoint\CoordinatePointType\CoordinatePointTypeRepositoryContract;
use App\Repositories\Backend\CoordinatePoint\CoordinatePointTypeService\CoordinatePointTypeServiceRepositoryContract;
use App\Services\Common\Helpers\Events;

class CoordinatePointTypeServiceController extends Controller
{
    protected $coordinatePointTypeServiceRepository;
    protected $coordinatePointTypeRepository;
    protected $coordinatePointServiceRepository;

    public function __construct(
        CoordinatePointTypeServiceRepositoryContract $coordinatePointTypeServiceRepository,
        CoordinatePointTypeRepositoryContract $coordinatePointTypeRepository,
        CoordinatePointServiceRepositoryContract $coordinatePointServiceRepository
    )
    {
        $this->coordinatePointTypeServiceRepository = $coordinatePointTypeServiceRepository;
        $this->coordinatePointServiceRepository = $coordinatePointServiceRepository;
        $this->coordinatePointTypeRepository = $coordinatePointTypeRepository;
        $this->middleware('coordinatePointTypeService.can-list', ['only' => ['index']]);
        $this->middleware('coordinatePointTypeService.can-show', ['only' => ['show']]);
        $this->middleware('coordinatePointTypeService.can-create', ['only' => ['create','store']]);
        $this->middleware('coordinatePointTypeService.can-edit', ['only' => ['edit','update']]);
        $this->middleware('coordinatePointTypeService.can-delete', ['only' => ['destroy']]);
    }
    public function index()
    {
        $coordinatePointTypeServices = $this->coordinatePointTypeServiceRepository->paginate();
        return view('backend.coordinatepoint.coordinatePointTypeService.index',compact('coordinatePointTypeServices'));
    }

    public function create($type_id)
    {
        $coordinatePointType=$this->coordinatePointTypeRepository->findById($type_id);
        $coordinatePointServices=$this->coordinatePointServiceRepository->all()->pluck('name','id');
        \Breadcrumbs::setCurrentRoute('admin.coordinatepointTypes.services.create', $coordinatePointType);
        return view('backend.coordinatepoint.coordinatePointTypeService.create', compact('coordinatePointType','coordinatePointServices'));
    }

    public function edit($type_id, $id)
    {
        $coordinatePointType=$this->coordinatePointTypeRepository->findById($type_id);
        $coordinatePointTypeService = $this->coordinatePointTypeServiceRepository->findById($id);
        $coordinatePointServices=$this->coordinatePointServiceRepository->all()->pluck('name','id');
        \Breadcrumbs::setCurrentRoute('admin.coordinatepointTypes.services.edit', $coordinatePointType, $coordinatePointTypeService);
        return view('backend.coordinatepoint.coordinatePointTypeService.edit',compact('coordinatePointTypeService', 'coordinatePointType','coordinatePointServices'));
    }

    public function show($type_id, $id)
    {
        $coordinatePointType=$this->coordinatePointTypeRepository->findById($type_id);
        $coordinatePointTypeService = $this->coordinatePointTypeServiceRepository->findById($id);
        \Breadcrumbs::setCurrentRoute('admin.coordinatepointTypes.services.show',$coordinatePointType, $coordinatePointTypeService);
        return view('backend.coordinatepoint.coordinatePointTypeService.show',compact('coordinatePointTypeService'));
    }

    public function destroy($type_id, $id)
    {
        $coordinatePointTypeService = $this->coordinatePointTypeServiceRepository->destroy($id);
        event(new UserModifiedEvent($coordinatePointTypeService, Events::DELETED));
        session()->flash('flash_message', trans('alerts.general.success_delete'));
        return redirect()->route('admin.coordinatepointTypes.show',$coordinatePointTypeService->coordinate_point_type_id);
    }
    public function store(StoreCoordinatePointTypeServiceRequest $request, $type_id)
    {
        $coordinatePointTypeService = $this->coordinatePointTypeServiceRepository->create($request->validated());
        $coordinatePointTypeService->setChanges($coordinatePointTypeService->getAttributes());
        event(new UserModifiedEvent($coordinatePointTypeService, Events::CREATED));
        session()->flash('flash_message', trans('alerts.general.success_add'));
        return redirect()->route('admin.coordinatepointTypes.show',$coordinatePointTypeService->coordinate_point_type_id);
    }
    public function update(UpdateCoordinatePointTypeServiceRequest $request, $type_id, $id)
    {
        $coordinatePointTypeService= $this->coordinatePointTypeServiceRepository->update($request->validated(), $id);
        event(new UserModifiedEvent($coordinatePointTypeService, Events::UPDATED));
        session()->flash('flash_message', trans('alerts.general.success_edit'));
        return redirect()->route('admin.coordinatepointTypes.show',$coordinatePointTypeService->coordinate_point_type_id);
    }

}