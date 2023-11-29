<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 11.07.2019
 * Time: 9:18
 */

namespace App\Http\Controllers\Backend\Web\JobLog;


use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Web\JobLog\IndexJobLogRequest;
use App\Repositories\Backend\JobLog\JobLogArchiveRepositoryContract;
use App\Repositories\Backend\JobLog\JobLogRepositoryContract;
use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;

class JobLogController extends Controller
{
    /**
     * @var JobLogRepositoryContract
     */
    private $jobLogRepositoryContract;
    private $jobLogArchiveRepositoryContract;

    /*
     * JobLogController constructor.
     * @param JobLogRepositoryContract $jobLogRepositoryContract
     */
    public function __construct(JobLogRepositoryContract $jobLogRepositoryContract, JobLogArchiveRepositoryContract $jobLogArchiveRepositoryContract)
    {
        $this->jobLogRepositoryContract = $jobLogRepositoryContract;
        $this->jobLogArchiveRepositoryContract = $jobLogArchiveRepositoryContract;
        $this->middleware('jobLog.can-list', ['only' => ['index']]);
        $this->middleware('jobLog.can-show', ['only' => ['show']]);
    }

    /*
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(IndexJobLogRequest $request)
    {
        $data = $request->validated();

        if(isset($data['is_from_archive']) && $data['is_from_archive']==true)
        {
            $jobLog = $this->jobLogArchiveRepositoryContract->paginate($data);
        }else{
            $jobLog = $this->jobLogRepositoryContract->paginate($data);
        }

        //dd($jobLog);
        $jobLog->appends($request->validated());
        if (isset($data['created_by_user_ids'])) unset($data['created_by_user_ids']);

        return view('backend.jobLog.index', compact('jobLog', 'data'));
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        //
        $jobLog = $this->jobLogRepositoryContract->getByIdWithCreatedBy($id);

        //dd($area);
        Breadcrumbs::setCurrentRoute('admin.jobLog.show', $jobLog);
        return view('backend.jobLog.show', compact('jobLog'));
    }

    public function archiveShow($id)
    {
        //
        $jobLog = $this->jobLogArchiveRepositoryContract->getByIdWithCreatedBy($id);

        //dd($area);
        Breadcrumbs::setCurrentRoute('admin.jobLog.show', $jobLog);
        return view('backend.jobLog.show', compact('jobLog'));
    }
}