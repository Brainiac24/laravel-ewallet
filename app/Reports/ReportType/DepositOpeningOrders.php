<?php
/**
 * Created by PhpStorm.
 * User: Nabijon
 * Date: 13.08.2021
 * Time: 16:45
 */

namespace App\Reports\ReportType;


use App\Http\Requests\Backend\Web\Report\DepositOpeningOrdersRequest;
use App\Reports\BaseReporter;
use App\Repositories\Backend\Order\OrderProcessStatus\OrderProcessStatusRepositoryContract;
use App\Repositories\Backend\Order\OrderRepositoryContract;
use App\Repositories\Backend\Order\OrderStatus\OrderStatusRepositoryContract;
use App\Services\Backend\Web\ExportJob\DepositOpeningOrders\DepositOpeningOrdersServiceContract;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Log;

class DepositOpeningOrders extends BaseReporter
{
    public $orderRepositoryContract;
    protected $depositOpeningOrdersService;
    protected $orderStatusRepositoryContract;
    protected $orderProcessStatusRepositoryContract;

    public function __construct(OrderRepositoryContract $orderRepositoryContract,
                                OrderStatusRepositoryContract $orderStatusRepositoryContract,
                                OrderProcessStatusRepositoryContract $orderProcessStatusRepositoryContract,
                                DepositOpeningOrdersServiceContract $depositOpeningOrdersServiceContract
                                )
    {
        $this->orderRepositoryContract = $orderRepositoryContract;
        $this->orderStatusRepositoryContract = $orderStatusRepositoryContract;
        $this->orderProcessStatusRepositoryContract = $orderProcessStatusRepositoryContract;
        $this->depositOpeningOrdersService = $depositOpeningOrdersServiceContract;
    }

    public function indexView(array $data) : View
    {
        $type_code = "depositOpeningOrders";
        $depositOpeningOrders = $this->orderRepositoryContract->paginateForDepositOpeningTransaction($data);
        $depositOpeningOrders->appends($data);
        $filterOrderStatus = $this->orderStatusRepositoryContract->listsAll()->prepend('', '');
        $filterOrderProcessStatus = $this->orderProcessStatusRepositoryContract->listsAll()->prepend('', '');
        return view('backend.reports.index', compact('depositOpeningOrders','data', 'type_code', 'filterOrderStatus', 'filterOrderProcessStatus'));

    }

    public function searchFiledsView() : View
    {
        $filterOrderStatus = $this->orderStatusRepositoryContract->listsAll()->prepend('', '');
        $filterOrderProcessStatus = $this->orderProcessStatusRepositoryContract->listsAll()->prepend('', '');
        return view('backend.reports.partials.fields_search_boxes.depositOpeningOrders', compact('filterOrderStatus', 'filterOrderProcessStatus'));
    }


    public function exportToCsv(array $data) : void
    {
        Log::info("in export to csv");
        $this->depositOpeningOrdersService->create($data);
    }

    public function getRequest() : FormRequest
    {
        return \App::make(DepositOpeningOrdersRequest::class);
    }
}