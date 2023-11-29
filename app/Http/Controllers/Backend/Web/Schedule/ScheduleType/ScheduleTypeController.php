<?php


namespace App\Http\Controllers\Backend\Web\Schedule\ScheduleType;


use App\Http\Controllers\Controller;
use App\Repositories\Backend\Schedule\ScheduleType\ScheduleTypeRepositoryContract;

class ScheduleTypeController extends Controller
{
    protected $scheduleTypeRepository;

    public function __construct(ScheduleTypeRepositoryContract $scheduleTypeRepository)
    {
        $this->scheduleTypeRepository = $scheduleTypeRepository;
        $this->middleware('ScheduleType.can-list', ['only' => ['index']]);
        $this->middleware('ScheduleType.can-show', ['only' => ['show']]);

    }

    public function index()
    {
        $scheduleTypes = $this->scheduleTypeRepository->paginate();
        return view('backend.schedule.scheduleType.index', compact('scheduleTypes'));
    }

    public function show($id)
    {
        $scheduleType = $this->scheduleTypeRepository->findById($id);
        \Breadcrumbs::setCurrentRoute('admin.scheduleTypes.show', $scheduleType);
        return view('backend.schedule.scheduleType.show', compact('scheduleType'));
    }
}