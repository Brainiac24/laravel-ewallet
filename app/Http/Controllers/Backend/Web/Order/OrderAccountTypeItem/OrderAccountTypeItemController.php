<?php

namespace App\Http\Controllers\Backend\Web\Order\OrderAccountTypeItem;

use DB;
use Breadcrumbs;
use Ramsey\Uuid\Uuid;
use App\Http\Controllers\Controller;
use App\Services\Common\Helpers\Events;
use App\Events\Backend\User\UserHistory\UserModifiedEvent;
use App\Repositories\Backend\Service\ServiceRepositoryContract;
use App\Repositories\Backend\Currency\CurrencyRepositoryContract;
use App\Http\Requests\Backend\Web\Order\OrderAccountTypeItem\StoreOrderAccountTypeItemRequest;
use App\Http\Requests\Backend\Web\Order\OrderAccountTypeItem\UpdateOrderAccountTypeItemRequest;
use App\Repositories\Backend\Order\OrderAccountType\OrderAccountTypeRepositoryContract;
use App\Repositories\Backend\Order\OrderAccountTypeItem\OrderAccountTypeItemRepositoryContract;


class OrderAccountTypeItemController extends Controller
{
   
    private $orderAccountTypeItemRepository;

    private $currencyRepository;
    private $orderAccountTypeRepository;
    protected $serviceRepository;


    public function __construct(OrderAccountTypeItemRepositoryContract $orderAccountTypeItemRepository,
                                CurrencyRepositoryContract $currencyRepository,
                                ServiceRepositoryContract $serviceRepository,
                                OrderAccountTypeRepositoryContract $orderAccountTypeRepository)
    {
        $this->orderAccountTypeItemRepository = $orderAccountTypeItemRepository;
        $this->currencyRepository = $currencyRepository;
        $this->serviceRepository = $serviceRepository;
        $this->orderAccountTypeRepository = $orderAccountTypeRepository;

        $this->middleware('orderAccountTypeItem.can-list', ['only' => ['index']]);
        $this->middleware('orderAccountTypeItem.can-show', ['only' => ['show']]);
        $this->middleware('orderAccountTypeItem.can-create', ['only' => ['create', 'store']]);
        $this->middleware('orderAccountTypeItem.can-edit', ['only' => ['edit', 'update']]);
        $this->middleware('orderAccountTypeItem.can-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $orderAccountTypeItems = $this->orderAccountTypeItemRepository->paginate();
        return view('backend.order.orderAccountTypeItem.index', compact('orderAccountTypeItems'));
    }

    public function create()
    {
        $currencies = $this->currencyRepository->listsAll()->prepend('', '');
        $order_account_types = $this->orderAccountTypeRepository->listsAll()->prepend('', '');
        return view('backend.order.orderAccountTypeItem.create',compact('currencies', 'order_account_types'));
    }

    public function store(StoreOrderAccountTypeItemRequest $request)
    {
        $data = $request->validated();

        try {
            DB::beginTransaction();
            
            $model = $this->orderAccountTypeItemRepository->create($data);
            $model->setChanges($model->getAttributes());
            event(new UserModifiedEvent($model, Events::CREATED));
            DB::commit();
            session()->flash('flash_message', trans('alerts.general.success_add'));
            return redirect()->route('admin.order.orderAccountTypeItem.index');
        }catch (\Exception $e) {
            DB::rollBack();
            session()->flash('flash_message_error', trans($e->getMessage()));
            return redirect()->route('admin.order.orderAccountTypeItem.create');
        }
    }

    public function edit($id)
    {
        $data = $this->orderAccountTypeItemRepository->getById($id);
        $currencies = $this->currencyRepository->listsAll()->prepend('', '');
        $order_account_types = $this->orderAccountTypeRepository->listsAll()->prepend('', '');
        Breadcrumbs::setCurrentRoute('admin.order.orderAccountTypeItem.edit', $data);
        return view('backend.order.orderAccountTypeItem.edit', compact('currencies','order_account_types','data'));
    }

    public function update(UpdateOrderAccountTypeItemRequest $request, $id)
    {
        $data = $request->validated();
        try {
            DB::beginTransaction();

            $model = $this->orderAccountTypeItemRepository->update($data, $id);
            event(new UserModifiedEvent($model, Events::UPDATED));
            DB::commit();
            session()->flash('flash_message', trans('alerts.general.success_edit'));
            return redirect()->route('admin.order.orderAccountTypeItem.index');
        }catch (\Exception $e) {
            DB::rollBack();
            session()->flash('flash_message_error', trans($e->getMessage()));
            return redirect()->route('admin.order.orderAccountTypeItem.edit',["id" => $id]);
        }
    }

    public function destroy($id)
    {
        try {
            $model = $this->orderAccountTypeItemRepository->destroy($id);
            event(new UserModifiedEvent($model, Events::DELETED));
            session()->flash('flash_message', trans('alerts.general.success_delete'));
            return redirect()->route('admin.order.orderAccountTypeItem.index');
        } catch (\Exception $e) {
            session()->flash('flash_message_error', trans('errorMessages.errors.try_errors.' . $e->getCode()));
            return redirect()->route('admin.order.orderAccountTypeItem.index');
        }
    }
}
