<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 01.08.2019
 * Time: 15:16
 */

namespace App\Http\Controllers\Backend\Web\Order;


use App\Events\Backend\User\UserHistory\UserModifiedEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Web\Order\IndexOrderRequest;
use App\Http\Requests\Backend\Web\Order\UpdateOrderRequest;
use App\Repositories\Backend\Order\OrderHistory\OrderHistoryRepositoryContract;
use App\Repositories\Backend\Order\OrderProcessStatus\OrderProcessStatusRepositoryContract;
use App\Repositories\Backend\Order\OrderRepositoryContract;
use App\Repositories\Backend\Order\OrderStatus\OrderStatusRepositoryContract;
use App\Repositories\Backend\Order\OrderType\OrderTypeRepositoryContract;
use App\Repositories\Backend\OrderCardType\OrderCardTypeRepositoryContract;
use App\Services\Backend\Web\ExportJob\OrderExportJob\OrderExportJobServiceContract;
use App\Services\Common\Helpers\Events;
use App\Services\Common\Helpers\OrderProcessStatus;
use App\Services\Common\Helpers\OrderType;
use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;

class OrderController extends Controller
{
    /**
     * @var OrderRepositoryContract
     */
    private $orderRepositoryContract;
    /**
     * @var OrderTypeRepositoryContract
     */
    private $orderTypeRepositoryContract;
    /**
     * @var OrderProcessStatusRepositoryContract
     */
    private $orderProcessStatusRepository;
    /**
     * @var OrderHistoryRepositoryContract
     */
    private $orderHistoryRepository;

    /**
     * @var OrderStatusRepositoryContract
     */
    private $orderStatusRepositoryContract;

    /**
     * @var OrderCardTypeRepositoryContract
     */
    private $orderCardTypeRepositoryContract;

    /**
     * @var OrderExportJobServiceContract
     */
    private $orderExportJobService;

    /**
     * OrderController constructor.
     * @param OrderRepositoryContract $orderRepositoryContract
     * @param OrderTypeRepositoryContract $orderTypeRepositoryContract
     * @param OrderProcessStatusRepositoryContract $orderProcessStatusRepository
     * @param OrderHistoryRepositoryContract $orderHistoryRepository
     */
    public function __construct(OrderRepositoryContract $orderRepositoryContract,
                                OrderTypeRepositoryContract $orderTypeRepositoryContract,
                                OrderProcessStatusRepositoryContract $orderProcessStatusRepository,
                                OrderHistoryRepositoryContract $orderHistoryRepository,
                                OrderStatusRepositoryContract $orderStatusRepositoryContract,
                                OrderExportJobServiceContract $orderExportJobService,
                                OrderCardTypeRepositoryContract $orderCardTypeRepositoryContract)
    {
        $this->middleware('order.can-list', ['only' => ['index']]);
        $this->middleware('order.can-show', ['only' => ['show']]);
        $this->middleware('order.can-edit', ['only' => ['edit', 'update']]);
        $this->orderRepositoryContract = $orderRepositoryContract;
        $this->orderTypeRepositoryContract = $orderTypeRepositoryContract;
        $this->orderProcessStatusRepository = $orderProcessStatusRepository;
        $this->orderStatusRepositoryContract = $orderStatusRepositoryContract;
        $this->orderHistoryRepository = $orderHistoryRepository;
        $this->orderCardTypeRepositoryContract = $orderCardTypeRepositoryContract;
        $this->orderExportJobService = $orderExportJobService;
    }

    public function Index(IndexOrderRequest $request)
    {
        $data = $request->validated();
        if ($request->export ?? false == true) {
            try{
                $this->orderExportJobService->create($data);
                session()->flash('flash_message', "Задача для формирование отчета создано. Вы сможете найти свою выгрузку в разделе \"Задачи\"");
                return redirect()->route('admin.orders.index');
            }catch (\Exception $e)
            {
                session()->flash('flash_message_error', $e->getMessage());
                return redirect()->route('admin.orders.index');
            }
        } else {
            $filterOrderTypes = $this->orderTypeRepositoryContract->getAll('')->pluck('name', 'id')->toArray();
            $filterOrderStatus = $this->orderStatusRepositoryContract->listsAll()->prepend('', '');
            $filterOrderProcessStatus = $this->orderProcessStatusRepository->listsAll()->prepend('', '');
            $orders = $this->orderRepositoryContract->paginate($data);
            //dd($orders);
            $orders->appends($request->validated());
            return view('backend.order.order.index', compact('orders', 'data', 'filterOrderTypes', 'filterOrderStatus', 'filterOrderProcessStatus'));
        }
    }

    public function show($id)
    {
        $data = $this->orderRepositoryContract->findById($id);
        $orderHistory = $this->orderHistoryRepository->findByOrderIdWithPaginate($id);
        //dd($id);
        $orderCardType = $this->orderCardTypeRepositoryContract->getById($data->payload_params_json["order_card_type_id"] ?? null);
        Breadcrumbs::setCurrentRoute('admin.orders.show', $data);
        return view('backend.order.order.show', compact('data','orderHistory','orderCardType'));
    }

    public function update(UpdateOrderRequest $request, $id)
    {
        $data = $request->validated();

        if($data['send_to_processing']=='on')
            $data['is_queued'] = '-1';

        $order = $this->orderRepositoryContract->update($data, $id);

        if($data['send_to_processing']=='on') {
            \Artisan::call('order:continue-process');
        }

        event(new UserModifiedEvent($order, Events::UPDATED));
        session()->flash('flash_message', trans('alerts.general.success_edit'));
        return redirect()->route('admin.orders.index');
    }

    public function edit($id)
    {
        $data = $this->orderRepositoryContract->findById($id);

        $orderProcessStatusId = $data->order_process_status_id;

        if ($data->order_type->id!=OrderType::ORDER_CARD)
        {
            session()->flash('flash_message_error', 'Упс! Нельзя редактировать тип заявки "'.$data->order_type->name.'"'??"");
            return redirect()->route('admin.orders.index');
        }

        $matrixOrderProcessStatus = array(
            OrderProcessStatus::NEW=>array("rule"=>array(OrderProcessStatus::NEW)),
            OrderProcessStatus::COMPLETED=>array("rule"=>array()),
            OrderProcessStatus::CREATE_DEPOSIT_STARTED=>array("rule"=>array()),
            OrderProcessStatus::CREATE_DEPOSIT_INPROCESS=>array("rule"=>array(OrderProcessStatus::NEW,OrderProcessStatus::REJECTED,OrderProcessStatus::CREATE_DEPOSIT_COMPLETED)),
            OrderProcessStatus::CREATE_DEPOSIT_REJEECTED=>array("rule"=>array(OrderProcessStatus::REJECTED)),
            OrderProcessStatus::CREATE_DEPOSIT_COMPLETED=>array("rule"=>array(OrderProcessStatus::CREATE_DEPOSIT_COMPLETED)),
            OrderProcessStatus::CREATE_DEPOSIT_UNKNOWN=>array("rule"=>array(OrderProcessStatus::NEW)),
            OrderProcessStatus::FILL_DEPOSIT_STARTED=>array("rule"=>array()),
            OrderProcessStatus::FILL_DEPOSIT_INPROCESS=>array("rule"=>array()),
            OrderProcessStatus::FILL_DEPOSIT_REJECTED=>array("rule"=>array(OrderProcessStatus::REJECTED)),
            OrderProcessStatus::FILL_DEPOSIT_COMPLETED=>array("rule"=>array(OrderProcessStatus::FILL_DEPOSIT_COMPLETED)),
            OrderProcessStatus::PAY_CARD_SERVICE_STARTED=>array("rule"=>array()),
            OrderProcessStatus::PAY_CARD_SERVICE_INPROCESS=>array("rule"=>array()),
            OrderProcessStatus::PAY_CARD_SERVICE_COMPLETED=>array("rule"=>array(OrderProcessStatus::PAY_CARD_SERVICE_COMPLETED)),
            OrderProcessStatus::PAY_CARD_SERVICE_UNKNOWN=>array("rule"=>array(OrderProcessStatus::PAY_CARD_SERVICE_COMPLETED, OrderProcessStatus::FILL_DEPOSIT_COMPLETED)),
            OrderProcessStatus::CREATE_CARD_STARTED=>array("rule"=>array(OrderProcessStatus::PAY_CARD_SERVICE_COMPLETED)),
            OrderProcessStatus::CREATE_CARD_INPROCESS=>array("rule"=>array(OrderProcessStatus::PAY_CARD_SERVICE_COMPLETED)),
            OrderProcessStatus::CREATE_CARD_COMPLETED=>array("rule"=>array()),
            OrderProcessStatus::CREATE_CARD_UNKNOWN=>array("rule"=>array(OrderProcessStatus::PAY_CARD_SERVICE_COMPLETED,OrderProcessStatus::CREATE_CARD_COMPLETED)),
        );


        if(count($matrixOrderProcessStatus[$orderProcessStatusId]['rule'])<=0){
            session()->flash('flash_message_error', 'Упс! Нельзя редактировать заявку c таким статусом');
            return redirect()->route('admin.orders.index');
        }

        $orderProcessStatus = $this->orderProcessStatusRepository->getByStatusIds($matrixOrderProcessStatus[$orderProcessStatusId]['rule'])->pluck('name','id')->prepend('', '');
        Breadcrumbs::setCurrentRoute('admin.orders.edit', $data);
        return view('backend.order.order.edit', compact('orderProcessStatus','data'));
    }
}