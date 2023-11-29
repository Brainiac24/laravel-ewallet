<?php

namespace App\Http\Controllers\Frontend\Api\Buglog;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\Api\Buglog\LogBuglogRequest;
use App\Repositories\Frontend\Buglog\BuglogRepositoryContract;


class BuglogController extends Controller
{

    protected $buglogRepository;

    function __construct(BuglogRepositoryContract $buglogRepository)
    {
        $this->buglogRepository = $buglogRepository;
    }

    public function log(LogBuglogRequest $request)
    {
        $data= $request->validated();
        $transaction = $this->buglogRepository->log($data);
        $code = 0;
        $data = ['buglog_id' => $transaction->id];
        return \response()->apiSuccess(compact('code', 'data'));
    }
}
