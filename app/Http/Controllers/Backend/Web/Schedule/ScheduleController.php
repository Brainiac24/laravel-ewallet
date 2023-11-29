<?php


namespace App\Http\Controllers\Backend\Web\Schedule;


use App\Events\Backend\User\UserHistory\UserModifiedEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Web\Schedule\StoreScheduleRequest;
use App\Http\Requests\Backend\Web\Schedule\UpdateScheduleRequest;
use App\Repositories\Backend\Schedule\ScheduleRepositoryContract;
use App\Repositories\Backend\Schedule\ScheduleType\ScheduleTypeRepositoryContract;
use App\Services\Common\Helpers\Events;

class ScheduleController extends Controller
{
    protected $scheduleTypeRepository;
    protected $scheduleRepository;

    public function __construct(ScheduleRepositoryContract $scheduleRepository, ScheduleTypeRepositoryContract $scheduleTypeRepository)
    {
        $this->scheduleTypeRepository = $scheduleTypeRepository;
        $this->scheduleRepository = $scheduleRepository;
        $this->middleware('Schedule.can-list', ['only' => ['index']]);
        $this->middleware('Schedule.can-edit', ['only' => ['edit', 'update']]);
        $this->middleware('Schedule.can-show', ['only' => ['show']]);
        $this->middleware('Schedule.can-create', ['only' => ['create', 'store']]);
        $this->middleware('Schedule.can-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $schedules = $this->scheduleRepository->paginate();
        return view('backend.schedule.index', compact('schedules'));
    }

    public function show($id)
    {
        $schedule = $this->scheduleRepository->findById($id);
        \Breadcrumbs::setCurrentRoute('admin.schedules.show', $schedule);
        return view('backend.schedule.show', compact('schedule'));
    }

    public function create()
    {
        $scheduleTypes = $this->scheduleTypeRepository->getAllTypeCommand()->pluck('name', 'id')->prepend("", "");
        return view('backend.schedule.create', compact('scheduleTypes'));
    }

    public function store(StoreScheduleRequest $request)
    {
        $data = $this->scheduleRepository->create($request->validated());
        $data->setChanges($data->getAttributes());
        event(new UserModifiedEvent($data, Events::CREATED));
        session()->flash('flash_message', trans('alerts.general.success_add'));

        return redirect()->route('admin.schedules.index');
    }

    public function edit($id)
    {
        $schedule = $this->scheduleRepository->findById($id);
        $scheduleTypes = $this->scheduleTypeRepository->getAllTypeCommand()->pluck('name', 'id')->prepend("", "");
        \Breadcrumbs::setCurrentRoute('admin.schedules.edit',$schedule);
        return view('backend.schedule.edit', compact('schedule', 'scheduleTypes'));
    }

    public function update(UpdateScheduleRequest $request, $id)
    {
        $data = $this->scheduleRepository->update($request->validated(), $id);
        event(new UserModifiedEvent($data, Events::UPDATED));
        session()->flash('flash_message', trans('alerts.general.success_edit'));
        return redirect()->route('admin.schedules.index');
    }

    public function destroy($id)
    {
        try {
            $data = $this->scheduleRepository->destroy($id);
            event(new UserModifiedEvent($data, Events::DELETED));
            session()->flash('flash_message', trans('alerts.general.success_delete'));
            return redirect()->route('admin.schedules.index');
        } catch (\Exception $e) {
            session()->flash('flash_message_error', trans('errorMessages.errors.try_errors.' . $e->getCode()));
            return redirect()->route('admin.schedules.index');
        }
    }
}