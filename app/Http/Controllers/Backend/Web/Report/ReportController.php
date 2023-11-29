<?php

namespace App\Http\Controllers\Backend\Web\Report;

use App\Exceptions\Backend\Web\ForbiddenException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Web\Report\ReportRequest;
use App\Repositories\Backend\ReportType\ReportTypeRepositoryContract;
use Complex\Exception;
use Illuminate\Http\Request;
use App\Reports\ReporterContract;


class ReportController extends Controller
{
    protected $reportTypeRepositoryContract;


    public function __construct(ReportTypeRepositoryContract $reportTypeRepositoryContract)
    {
        $this->reportTypeRepositoryContract = $reportTypeRepositoryContract;
        $this->middleware('reports.can-list', ['only' => ['index']]);
    }

    public function index(ReportRequest $request)
    {
        $reportType = $this->reportTypeRepositoryContract->findById($request->get("report_type_id"));
        $type_code = $reportType["code"] ?? "Default";

        if($type_code === "Default") {
            return view('backend.reports.index', ["type_code" => "default", "data" => []]);
        }

        if (!\Auth::user()->ability("sadmin", ["report-type-" . $type_code])) {
            throw new ForbiddenException("У Вас нету право!");
        }

        $Report = \App::make("App\Reports\ReportType\\$type_code");

        if($Report instanceof ReporterContract){
            return $Report->applyIndex();
        }else{
            session()->flash('flash_message_error', "Неизвестный отчет");
            return view('backend.reports.index', ["type_code" => "default", "data" => []]);
        }
    }

    public function getSearchFileds(Request $request)
    {
        $reportType = $this->reportTypeRepositoryContract->findById($request->get("report_type_id"));
        $type_code = $reportType["code"] ?? "Default";

        if($type_code === "Default") {
            return "";
        }

        if (!\Auth::user()->ability("sadmin", ["report-type-" . $type_code])) {
            throw new ForbiddenException("У Вас нету право!");
        }

        $Report = \App::make("App\Reports\ReportType\\$type_code");

        if($Report instanceof ReporterContract){
            return $Report->searchFiledsView();
        }else{
            return "";
        }
    }
}
