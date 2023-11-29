<?php

namespace App\Reports\ReportType;

use App\Reports\BaseReporter;
use App\Services\Backend\Web\Merchant\MerchantServiceContract;
use App\Http\Requests\Backend\Web\Report\IndexMerchantRequest;
use App\Services\Backend\Web\ExportJob\MerchantExportJob\MerchantExportJobServiceContract;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Http\FormRequest;

class Merchants extends BaseReporter
{
    protected $merchantExportJobService;
    protected $merchantService;

    public function __construct(MerchantExportJobServiceContract $merchantExportJobServiceContract,
                                MerchantServiceContract $merchantServiceContract
    )
    {
        $this->merchantExportJobService = $merchantExportJobServiceContract;
        $this->merchantService = $merchantServiceContract;
    }

    public function indexView(array $data) : View
    {
        $type_code = "merchants";
        $merchants = $this->merchantService->getTableList($data);
        $branchs = $this->merchantService->branchList();
        return view('backend.reports.index', compact('merchants', 'data', 'branchs', 'type_code'));
    }

    public function exportToCsv(array $data) : void
    {
        $this->merchantExportJobService->create($data);
    }

    public function searchFiledsView() : View
    {
        $data = [];
        $branchs = $this->merchantService->branchList();
        return view('backend.reports.partials.fields_search_boxes.merchants', compact( 'data', 'branchs'));
    }

    public function getRequest() : FormRequest
    {
        return \App::make(IndexMerchantRequest::class);
    }
}