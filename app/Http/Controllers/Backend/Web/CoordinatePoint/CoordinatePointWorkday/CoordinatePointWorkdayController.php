<?php


namespace App\Http\Controllers\Backend\Web\CoordinatePoint\CoordinatePointWorkday;


use App\Events\Backend\User\UserHistory\UserModifiedEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Web\CoordinatePoint\CoordinatePointWorkday\StoreCoordinatePointWorkdayRequest;
use App\Http\Requests\Backend\Web\CoordinatePoint\CoordinatePointWorkday\UpdateCoordinatePointWorkdayRequest;
use App\Repositories\Backend\CoordinatePoint\CoordinatePointWorkday\CoordinatePointWorkdayRepositoryContract;
use App\Services\Common\Helpers\Events;

class CoordinatePointWorkdayController extends Controller
{
    protected $coordinatePointWorkdayRepository;

    public function __construct(CoordinatePointWorkdayRepositoryContract $coordinatePointWorkdayRepository)
    {
        $this->coordinatePointWorkdayRepository = $coordinatePointWorkdayRepository;
        $this->middleware('coordinatePointWorkday.can-list', ['only' => ['index']]);
        $this->middleware('coordinatePointWorkday.can-show', ['only' => ['show']]);
        $this->middleware('coordinatePointWorkday.can-create', ['only' => ['create','store']]);
        $this->middleware('coordinatePointWorkday.can-edit', ['only' => ['edit','update']]);
        $this->middleware('coordinatePointWorkday.can-delete', ['only' => ['destroy']]);
    }
    public function index()
    {
        $coordinatePointWorkdays = $this->coordinatePointWorkdayRepository->paginate();
        return view('backend.coordinatepoint.coordinatePointWorkday.index',compact('coordinatePointWorkdays'));
    }

    public function create()
    {
        return view('backend.coordinatepoint.coordinatePointWorkday.create');
    }

    public function edit($id)
    {
        $coordinatePointWorkday = $this->coordinatePointWorkdayRepository->findById($id);
        \Breadcrumbs::setCurrentRoute('admin.coordinatepointWorkdays.edit', $coordinatePointWorkday);
        return view('backend.coordinatepoint.coordinatePointWorkday.edit',compact('coordinatePointWorkday'));
    }

    public function show($id)
    {
        $coordinatePointWorkday = $this->coordinatePointWorkdayRepository->findById($id);
        \Breadcrumbs::setCurrentRoute('admin.coordinatepointWorkdays.show', $coordinatePointWorkday);
        return view('backend.coordinatepoint.coordinatePointWorkday.show',compact('coordinatePointWorkday'));
    }

    public function destroy($id)
    {
        $coordinatePointWorkday = $this->coordinatePointWorkdayRepository->destroy($id);
        event(new UserModifiedEvent($coordinatePointWorkday, Events::DELETED));
        session()->flash('flash_message', trans('alerts.general.success_delete'));
        return redirect()->route('admin.coordinatepointWorkdays.index');
    }
    public function store(StoreCoordinatePointWorkdayRequest $request)
    {
        $coordinatePointWorkday = $this->coordinatePointWorkdayRepository->create($request->validated());
        $coordinatePointWorkday->setChanges($coordinatePointWorkday->getAttributes());
        event(new UserModifiedEvent($coordinatePointWorkday, Events::CREATED));
        session()->flash('flash_message', trans('alerts.general.success_add'));
        return redirect()->route('admin.coordinatepointWorkdays.index');
    }
    public function update(UpdateCoordinatePointWorkdayRequest $request, $id)
    {
        $coordinatePointWorkday= $this->coordinatePointWorkdayRepository->update($request->validated(), $id);
        event(new UserModifiedEvent($coordinatePointWorkday, Events::UPDATED));
        session()->flash('flash_message', trans('alerts.general.success_edit'));
        return redirect()->route('admin.coordinatepointWorkdays.index');
    }

}