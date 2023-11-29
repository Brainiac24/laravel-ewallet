<?php
namespace App\Http\Controllers\Backend\Web\Job\JobHistory;


use App\Exceptions\Backend\Web\ForbiddenException;
use App\Exports\Transactions\TransactionExportCsv;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Web\Job\JobHistory\IndexJobHistoryRequest;
use App\Repositories\Backend\Job\JobHistory\JobHistoryRepositoryContract;
use App\Services\Common\Helpers\JobHistoryType;
use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;

class JobHistoryController extends Controller
{
    /**
     * @var JobHistoryRepositoryContract
     */
    private $jobHistoryRepository;

    /*
     * JobHistoryController constructor.
     * @param JobHistoryRepositoryContract $jobHistoryRepositoryContract
     */
    public function __construct(JobHistoryRepositoryContract $jobHistoryRepositoryContract)
    {
        $this->jobHistoryRepository = $jobHistoryRepositoryContract;
        $this->middleware('jobHistory.can-list', ['only' => ['index']]);
        $this->middleware('jobHistoryCommand.can-list', ['only' => ['indexCommand']]);
        $this->middleware('jobHistory.can-show', ['only' => ['show']]);
    }

    /*
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(IndexJobHistoryRequest $request)
    {
        $data = $request->validated();

        if(!\Auth::user()->ability("sadmin", "jobHistory-can-all") &&
            \Auth::user()->can("jobHistory-can-by-user")){
            $data['created_by_user_id'] = \Auth::user()->id;
        }
        $data['type'] = JobHistoryType::EXPORT;
        $jobHistory = $this->jobHistoryRepository->paginate($data);
        if(isset($data['created_by_user_id'])) unset($data['created_by_user_id']);
        if(isset($data['type'])) unset($data['type']);
        return view('backend.job.jobHistory.index', compact('jobHistory', 'data'));
    }
    /*
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function indexCommand(IndexJobHistoryRequest $request)
    {
        $data = $request->validated();
        $data['type'] = JobHistoryType::COMMAND;
        $jobHistory = $this->jobHistoryRepository->paginate($data);
        if(isset($data['created_by_user_id'])) unset($data['created_by_user_id']);
        if(isset($data['type'])) unset($data['type']);
        return view('backend.job.jobHistory.index', compact('jobHistory', 'data'));
    }

    /*
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */

    public function show($id)
    {
        $jobHistory = $this->jobHistoryRepository->findById($id);
        if(!\Auth::user()->ability("sadmin", "jobHistory-can-all") &&
            \Auth::user()->can("jobHistory-can-by-user") &&
            $jobHistory->created_by_user_id != \Auth::user()->id
        ){
            throw new ForbiddenException();
        }

        Breadcrumbs::setCurrentRoute('admin.jobHistory.show', $jobHistory);
        return view('backend.job.jobHistory.show', compact('jobHistory'));
    }

    public function download($basefilename)
    {
        //$path = storage_path("transaction_reports/{$filename}");
        $filename = TransactionExportCsv::getFilename($basefilename);
        if(\File::exists($filename)){
            return response()->download($filename);
        }else {
            session()->flash('flash_message_error', trans("File {$basefilename} not found!"));
            return redirect()->route('admin.jobHistory.index');
        }
    }
}