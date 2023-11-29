<?php


namespace App\Http\Controllers\Backend\Web\Report\ReportAnalysis;


use App\Events\Backend\User\UserHistory\UserModifiedEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Web\Report\ReportAnalysis\StoreReportAnalysisRequest;
use App\Http\Requests\Backend\Web\Report\ReportAnalysis\UpdateReportAnalysisRequest;
use App\Repositories\Backend\Account\AccountType\AccountTypeRepositoryContract;
use App\Repositories\Backend\Gateway\GatewayRepositoryContract;
use App\Repositories\Backend\ReportAnalysis\ReportAnalysisRepositoryContract;
use App\Repositories\Backend\Service\ServiceRepositoryContract;
use App\Services\Common\Helpers\Events;

class ReportAnalysisController extends Controller
{

    private $reportAnalysisRepository;
    private $serviceRepository;
    private $accountTypeRepository;

    public function __construct(ReportAnalysisRepositoryContract $reportAnalysisRepository,
                    ServiceRepositoryContract $serviceRepository,
                    AccountTypeRepositoryContract $accountTypeRepository
    )
    {
        $this->middleware('reportAnalysis.can-list', ['only' => ['index']]);
        $this->middleware('reportAnalysis.can-create', ['only' => ['create', 'store']]);
        $this->middleware('reportAnalysis.can-edit', ['only' => ['edit', 'update']]);
        $this->middleware('reportAnalysis.can-delete', ['only' => ['destroy']]);

        $this->reportAnalysisRepository = $reportAnalysisRepository;
        $this->serviceRepository = $serviceRepository;
        $this->accountTypeRepository = $accountTypeRepository;
    }

    public function Index()
    {
        $reportAnalyzes = $this->reportAnalysisRepository->paginate();
        return view('backend.reports.reportAnalysis.index', compact('reportAnalyzes'));
    }

    public function show($id)
    {
        $data = $this->reportAnalysisRepository->getById($id);
        \Breadcrumbs::setCurrentRoute('admin.report_analysis.show', $data);
        return view('backend.reports.reportAnalysis.show', compact('data'));
    }

    public function create()
    {
        $services = $this->serviceRepository->allPluck();
        $accountTypes = $this->accountTypeRepository->listsAll();
        return view('backend.reports.reportAnalysis.create', compact('services', 'accountTypes'));
    }

    public function store(StoreReportAnalysisRequest $request)
    {
        $data = $request->validated();
        $merchant = $this->reportAnalysisRepository->create($data);
        $merchant->setChanges($merchant->getAttributes());
        event(new UserModifiedEvent($merchant, Events::CREATED));
        session()->flash('flash_message', trans('alerts.general.success_add'));
        return redirect()->route('admin.report_analysis.index');
    }

    public function edit($id)
    {
        $reportAnalysis = $this->reportAnalysisRepository->getById($id);
        $services = $this->serviceRepository->allPluck();
        $accountTypes = $this->accountTypeRepository->listsAll();
        $selectedExpenseServices = $reportAnalysis->params_json['expenseServices']??[];
        $selectedIncomeAccountTypes = $reportAnalysis->params_json['incomeAccountTypes']??[];
        $selectedIncomeServices = $reportAnalysis->params_json['incomeServices']??[];
        $selectedExpenseAccountTypes = $reportAnalysis->params_json['expenseAccountTypes']??[];
        \Breadcrumbs::setCurrentRoute('admin.report_analysis.edit', $reportAnalysis);
        return view('backend.reports.reportAnalysis.edit',
            compact('reportAnalysis', 'accountTypes', 'services', 'selectedExpenseAccountTypes',
                'selectedExpenseServices', 'selectedIncomeAccountTypes', 'selectedIncomeServices'));
    }

    public function update(UpdateReportAnalysisRequest $request, $id)
    {
        $data = $this->reportAnalysisRepository->update($request->validated(), $id);
        event(new UserModifiedEvent($data, Events::UPDATED));
        session()->flash('flash_message', trans('alerts.general.success_edit'));
        return redirect()->route('admin.report_analysis.index');
    }

    public function destroy($id)
    {
        try {
            $data = $this->reportAnalysisRepository->destroy($id);
            event(new UserModifiedEvent($data, Events::DELETED));
            session()->flash('flash_message', trans('alerts.general.success_delete'));
            return redirect()->route('admin.report_analysis.index');
        } catch (\Exception $e) {
            session()->flash('flash_message_error', trans('errorMessages.errors.try_errors.' . $e->getCode()));
            return redirect()->route('admin.report_analysis.index');
        }
    }
}