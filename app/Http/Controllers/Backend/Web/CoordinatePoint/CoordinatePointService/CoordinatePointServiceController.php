<?php


namespace App\Http\Controllers\Backend\Web\CoordinatePoint\CoordinatePointService;


use App\Events\Backend\User\UserHistory\UserModifiedEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Web\CoordinatePoint\CoordinatePointService\StoreCoordinatePointServiceRequest;
use App\Http\Requests\Backend\Web\CoordinatePoint\CoordinatePointService\UpdateCoordinatePointServiceRequest;
use App\Repositories\Backend\CoordinatePoint\CoordinatePointService\CoordinatePointServiceRepositoryContract;
use App\Services\Common\Helpers\Events;

class CoordinatePointServiceController extends Controller
{
    protected $coordinatePointServiceRepository;

    public function __construct(CoordinatePointServiceRepositoryContract $coordinatePointServiceRepository)
    {
        $this->coordinatePointServiceRepository = $coordinatePointServiceRepository;
        $this->middleware('coordinatePointService.can-list', ['only' => ['index']]);
        $this->middleware('coordinatePointService.can-show', ['only' => ['show']]);
        $this->middleware('coordinatePointService.can-create', ['only' => ['create','store']]);
        $this->middleware('coordinatePointService.can-edit', ['only' => ['edit','update']]);
        $this->middleware('coordinatePointService.can-delete', ['only' => ['destroy']]);
    }
    public function index()
    {
        $coordinatePointServices = $this->coordinatePointServiceRepository->paginate();
        return view('backend.coordinatepoint.coordinatePointService.index',compact('coordinatePointServices'));
    }

    public function create()
    {
        return view('backend.coordinatepoint.coordinatePointService.create');
    }

    public function edit($id)
    {
        $coordinatePointService = $this->coordinatePointServiceRepository->findById($id);
        \Breadcrumbs::setCurrentRoute('admin.coordinatepointServices.edit', $coordinatePointService);
        return view('backend.coordinatepoint.coordinatePointService.edit',compact('coordinatePointService'));
    }

    public function show($id)
    {
        $coordinatePointService = $this->coordinatePointServiceRepository->findById($id);
        \Breadcrumbs::setCurrentRoute('admin.coordinatepointServices.show', $coordinatePointService);
        return view('backend.coordinatepoint.coordinatePointService.show',compact('coordinatePointService'));
    }

    public function destroy($id)
    {
        $coordinatePointService = $this->coordinatePointServiceRepository->destroy($id);
        event(new UserModifiedEvent($coordinatePointService, Events::DELETED));
        session()->flash('flash_message', trans('alerts.general.success_delete'));
        return redirect()->route('admin.coordinatepointServices.index');
    }
    public function store(StoreCoordinatePointServiceRequest $request)
    {
        $coordinatePointService = $this->coordinatePointServiceRepository->create($request->validated());
        $coordinatePointService->setChanges($coordinatePointService->getAttributes());
        event(new UserModifiedEvent($coordinatePointService, Events::CREATED));
        session()->flash('flash_message', trans('alerts.general.success_add'));
        return redirect()->route('admin.coordinatepointServices.index');
    }
    public function update(UpdateCoordinatePointServiceRequest $request, $id)
    {
        $coordinatePointService= $this->coordinatePointServiceRepository->update($request->validated(), $id);
        event(new UserModifiedEvent($coordinatePointService, Events::UPDATED));
        session()->flash('flash_message', trans('alerts.general.success_edit'));
        return redirect()->route('admin.coordinatepointServices.index');
    }
}