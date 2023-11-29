<?php


namespace App\Http\Controllers\Backend\Web\Schedule\ScheduleJob;


use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Web\Schedule\ScheduleJob\StoreScheduleJobRequest;
use App\Jobs\Gateway\GatewayOnOffJob;
use App\Repositories\Backend\Schedule\ScheduleJob\ScheduleJobRepositoryContract;
use App\Repositories\Backend\Schedule\ScheduleType\ScheduleTypeRepositoryContract;
use Carbon\Carbon;
use function Composer\Autoload\includeFile;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Http\Request;

class ScheduleJobController extends Controller
{
    protected $scheduleTypeRepository;
    protected $scheduleJobRepository;

    public function __construct(ScheduleTypeRepositoryContract $scheduleTypeRepository,
                                ScheduleJobRepositoryContract $scheduleJobRepository
        )
    {
        $this->scheduleTypeRepository = $scheduleTypeRepository;
        $this->scheduleJobRepository = $scheduleJobRepository;
        $this->middleware('ScheduleJob.can-list', ['only' => ['index']]);
        $this->middleware('ScheduleJob.can-show', ['only' => ['show']]);
        $this->middleware('ScheduleJob.can-create', ['only' => ['create', 'store', 'generateView']]);
    }

    public function index()
    {
        $scheduleJobs = $this->scheduleJobRepository->paginate();
        $data = $this->scheduleTypeRepository->getAllTypeJob();
        $scheduleTypes = [];
        foreach ($data as $item) {
            $scheduleTypes[$item->value] = $item;
        }
        return view('backend.schedule.scheduleJob.index', compact('scheduleJobs','scheduleTypes'));
    }

    public function create()
    {
        $scheduleTypes = $this->scheduleTypeRepository->getAllTypeJob()->pluck('name', 'id')->prepend('', '');
        return view('backend.schedule.scheduleJob.create', compact('scheduleTypes'));
    }

    public function store(StoreScheduleJobRequest $request)
    {
        $scheduleType = $this->scheduleTypeRepository->findById($request->schedule_type_id);
        $fields = json_decode($scheduleType->fields, true);
        $rules = [];
        $data = $request->all();
        if (is_array($fields)){
            foreach ($fields as $field) {
                $rules[$field['name']] = 'required';
            }
        }
        $data['from_date']= str_replace('T', ' ', $request->get('from_date'));
        $validator = \Validator::make($data, $rules);
        if ($validator->fails()){
            return redirect()->route('admin.scheduleJobs.create');
        }
        $payload = [];
        foreach ($fields as $field) {
            $payload[$field['name']] = $data[$field['name']];
        }
        $obj = new $scheduleType->value($payload);
        if($obj instanceof  ShouldQueue){
            dispatch($obj)->delay(Carbon::parse($data['from_date']))->onQueue('scheduler_jobs');
        }
        return redirect()->route('admin.scheduleJobs.index');


    }

    public function generateView()
    {
        $scheduleType = $this->scheduleTypeRepository->findById(\request()->get('schedule_type_id'));
        $fields = json_decode($scheduleType->fields, true);
        foreach ($fields as $key=>$field) {
            if ($field['type'] == 'select'){
                if ($field['name'] == 'is_active'){
                    $fields[$key]['entity'] = trans('InterfaceTranses.enabled');
                }else{
                    $repository = \App::make($field['entity']);
                    $fields[$key]['entity'] = $repository->all()->pluck('name', 'id')->prepend('', '');
                }
            }
        }
        return view('backend.schedule.scheduleJob.partials.fields', compact('fields'));
    }

    public function show($id)
    {
        $scheduleJob = $this->scheduleJobRepository->findById($id);
        $data = $this->scheduleTypeRepository->getAllTypeJob();
        $scheduleTypes = [];
        foreach ($data as $item) {
            $scheduleTypes[$item->value] = $item;
        }
        return view('backend.schedule.scheduleJob.show', compact('scheduleJob', 'scheduleTypes'));
    }
}