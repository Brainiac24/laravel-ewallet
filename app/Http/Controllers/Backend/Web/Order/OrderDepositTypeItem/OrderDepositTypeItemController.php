<?php

namespace App\Http\Controllers\Backend\Web\Order\OrderDepositTypeItem;

use DB;
use Breadcrumbs;
use Ramsey\Uuid\Uuid;
use App\Http\Controllers\Controller;
use App\Services\Common\Helpers\Events;
use App\Services\Common\Image\ImageServiceContract;
use App\Events\Backend\User\UserHistory\UserModifiedEvent;
use App\Repositories\Backend\Service\ServiceRepositoryContract;
use App\Repositories\Backend\Currency\CurrencyRepositoryContract;
use App\Http\Requests\Backend\Web\Order\OrderDepositType\StoreOrderDepositTypeRequest;
use App\Http\Requests\Backend\Web\Order\OrderDepositType\UpdateOrderDepositTypeRequest;
use App\Http\Requests\Backend\Web\Order\OrderDepositTypeItem\StoreOrderDepositTypeItemRequest;
use App\Http\Requests\Backend\Web\Order\OrderDepositTypeItem\UpdateOrderDepositTypeItemRequest;
use App\Repositories\Backend\Order\OrderDepositType\OrderDepositTypeRepositoryContract;
use App\Repositories\Backend\Order\OrderDepositTypeItem\OrderDepositTypeItemRepositoryContract;
use App\Repositories\Backend\OrderCardContractType\OrderCardContractTypeRepositoryContract;


class OrderDepositTypeItemController extends Controller
{
   
    private $orderDepositTypeItemRepository;

    private $currencyRepository;
    private $orderDepositTypeRepository;
    protected $serviceRepository;


    public function __construct(OrderDepositTypeItemRepositoryContract $orderDepositTypeItemRepository,
                                CurrencyRepositoryContract $currencyRepository,
                                ServiceRepositoryContract $serviceRepository,
                                OrderDepositTypeRepositoryContract $orderDepositTypeRepository)
    {
        $this->orderDepositTypeItemRepository = $orderDepositTypeItemRepository;
        $this->currencyRepository = $currencyRepository;
        $this->serviceRepository = $serviceRepository;
        $this->orderDepositTypeRepository = $orderDepositTypeRepository;

        $this->middleware('orderDepositTypeItem.can-list', ['only' => ['index']]);
        $this->middleware('orderDepositTypeItem.can-show', ['only' => ['show']]);
        $this->middleware('orderDepositTypeItem.can-create', ['only' => ['create', 'store']]);
        $this->middleware('orderDepositTypeItem.can-edit', ['only' => ['edit', 'update']]);
        $this->middleware('orderDepositTypeItem.can-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $orderDepositTypeItems = $this->orderDepositTypeItemRepository->paginate();
        return view('backend.order.orderDepositTypeItem.index', compact('orderDepositTypeItems'));
    }

    public function create()
    {
        $currencies = $this->currencyRepository->listsAll()->prepend('', '');
        $order_deposit_types = $this->orderDepositTypeRepository->listsAll()->prepend('', '');
        return view('backend.order.orderDepositTypeItem.create',compact('currencies', 'order_deposit_types'));
    }

    public function store(StoreOrderDepositTypeItemRequest $request)
    {
        $data = $request->validated();

        try {
            DB::beginTransaction();
            
            $model = $this->orderDepositTypeItemRepository->create($data);
            $model->setChanges($model->getAttributes());
            event(new UserModifiedEvent($model, Events::CREATED));
            DB::commit();
            session()->flash('flash_message', trans('alerts.general.success_add'));
            return redirect()->route('admin.order.orderDepositTypeItem.index');
        }catch (\Exception $e) {
            DB::rollBack();
            session()->flash('flash_message_error', trans($e->getMessage()));
            return redirect()->route('admin.order.orderDepositTypeItem.create');
        }
    }

    public function edit($id)
    {
        $data = $this->orderDepositTypeItemRepository->getById($id);
        $currencies = $this->currencyRepository->listsAll()->prepend('', '');
        $order_deposit_types = $this->orderDepositTypeRepository->listsAll()->prepend('', '');
        Breadcrumbs::setCurrentRoute('admin.order.orderDepositTypeItem.edit', $data);
        return view('backend.order.orderDepositTypeItem.edit', compact('currencies','order_deposit_types','data'));
    }

    public function update(UpdateOrderDepositTypeItemRequest $request, $id)
    {
        $data = $request->validated();
        try {
            DB::beginTransaction();

            $model = $this->orderDepositTypeItemRepository->update($data, $id);
            event(new UserModifiedEvent($model, Events::UPDATED));
            DB::commit();
            session()->flash('flash_message', trans('alerts.general.success_edit'));
            return redirect()->route('admin.order.orderDepositTypeItem.index');
        }catch (\Exception $e) {
            DB::rollBack();
            session()->flash('flash_message_error', trans($e->getMessage()));
            return redirect()->route('admin.order.orderDepositTypeItem.edit',["id" => $id]);
        }
    }

    public function destroy($id)
    {
        try {
            $model = $this->orderDepositTypeItemRepository->destroy($id);
            event(new UserModifiedEvent($model, Events::DELETED));
            session()->flash('flash_message', trans('alerts.general.success_delete'));
            return redirect()->route('admin.order.orderDepositTypeItem.index');
        } catch (\Exception $e) {
            session()->flash('flash_message_error', trans('errorMessages.errors.try_errors.' . $e->getCode()));
            return redirect()->route('admin.order.orderDepositTypeItem.index');
        }
    }
}
