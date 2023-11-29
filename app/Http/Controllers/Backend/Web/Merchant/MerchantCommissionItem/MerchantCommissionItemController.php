<?php
/**
 * Created by PhpStorm.
 * User: Ladmin
 * Date: 24.02.2020
 * Time: 13:14
 */

namespace App\Http\Controllers\Backend\Web\Merchant\MerchantCommissionItem;


use App\Events\Backend\User\UserHistory\UserModifiedEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Web\Merchant\MerchantCommissionItem\IndexMerchantCommissionItemRequest;
use App\Http\Requests\Backend\Web\Merchant\MerchantCommissionItem\StoreMerchantCommissionItemRequest;
use App\Http\Requests\Backend\Web\Merchant\MerchantCommissionItem\UpdateMerchantCommissionItemRequest;
use App\Repositories\Backend\Merchant\MerchantCommission\MerchantCommissionRepositoryContract;
use App\Repositories\Backend\Merchant\MerchantCommissionItem\MerchantCommissionItemRepositoryContract;
use App\Services\Common\Helpers\Events;
use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;

class MerchantCommissionItemController extends Controller
{
    /**
     * @var MerchantCommissionItemRepositoryContract
     */
    private $merchantCommissionItemRepository;
    /**
     * @var MerchantCommissionRepositoryContract
     */
    private $merchantCommissionRepository;

    /**
     * MerchantCommissionItemController constructor.
     * @param MerchantCommissionItemRepositoryContract $merchantCommissionItemRepository
     * @param MerchantCommissionRepositoryContract $merchantCommissionRepository
     */
    public function __construct(MerchantCommissionItemRepositoryContract $merchantCommissionItemRepository, MerchantCommissionRepositoryContract $merchantCommissionRepository)
    {
        $this->merchantCommissionItemRepository = $merchantCommissionItemRepository;

        $this->middleware('merchant.commission.item.can-list', ['only' => ['index']]);
        $this->middleware('merchant.commission.item.can-show', ['only' => ['show']]);
        $this->middleware('merchant.commission.item.can-create', ['only' => ['create', 'store']]);
        $this->middleware('merchant.commission.item.can-edit', ['only' => ['edit', 'update']]);
        $this->middleware('merchant.commission.item.can-delete', ['only' => ['destroy']]);
        $this->merchantCommissionRepository = $merchantCommissionRepository;
    }

    public function Index(IndexMerchantCommissionItemRequest $request)
    {
        $data=$request->validated();
        $merchantCommissionItems = $this->merchantCommissionItemRepository->paginate($data);
        $merchantCommissionItems->appends($data);

        return view('backend.merchant.merchantCommissionItem.index', compact('merchantCommissionItems','data'));
    }

    public function show($merchant_commission_id, $id)
    {
        $data = $this->merchantCommissionItemRepository->findById($id);

        Breadcrumbs::setCurrentRoute('admin.merchants.commission.items.show',$merchant_commission_id, $data);
        return view('backend.merchant.merchantCommissionItem.show', compact('data'));
    }

    public function create($merchant_commission_id)
    {
        //$filterMerchantCommissions = $this->merchantCommissionRepository->all('')->pluck('name', 'id')->toArray();

        $maxValue = $this->merchantCommissionItemRepository->GetMaxValueFromColumnMaxByMerchantCommissionId($merchant_commission_id);
        $maxValue = $maxValue+0.01;

        $merchant_commission = $this->merchantCommissionRepository->findById($merchant_commission_id);
        $merchant_commission_name=$merchant_commission->name;
        return view('backend.merchant.merchantCommissionItem.create', compact('data','merchant_commission_name','merchant_commission_id','maxValue'));
    }

    public function store(StoreMerchantCommissionItemRequest $request, $merchant_commission_id)
    {
        //
        $data = $request->validated();

        $maxValue = $this->merchantCommissionItemRepository->GetMaxValueFromColumnMaxByMerchantCommissionId($merchant_commission_id);
        if($data['min']>=$data['max'] || $data['min']<=$maxValue){
            session()->flash('flash_message_error', trans('Задан ошибочный интервал!'));
            return redirect()->route('admin.merchants.commission.items.create',$merchant_commission_id);
        }

        $data['merchant_commission_id']=$merchant_commission_id;
        $merchantCommissionItem = $this->merchantCommissionItemRepository->create($data);
        $merchantCommissionItem->setChanges($merchantCommissionItem->getAttributes());
        event(new UserModifiedEvent($merchantCommissionItem, Events::CREATED));
        session()->flash('flash_message', trans('alerts.general.success_add'));
        return redirect()->route('admin.merchants.commissions.show',$merchant_commission_id);
    }

    public function edit($merchant_commission_id, $id)
    {
        $data = $this->merchantCommissionItemRepository->findById($id);
        $filterMerchantCommissions = $this->merchantCommissionRepository->all('')->pluck('name', 'id')->toArray();

        Breadcrumbs::setCurrentRoute('admin.merchants.commission.items.edit', $merchant_commission_id, $data);
        return view('backend.merchant.merchantCommissionItem.edit', compact('data','filterMerchantCommissions','merchant_commission_id'));
    }

    public function update(UpdateMerchantCommissionItemRequest $request, $merchant_commission_id, $id)
    {
        //
        $data = $this->merchantCommissionItemRepository->update($request->validated(), $id);

        event(new UserModifiedEvent($data, Events::UPDATED));
        session()->flash('flash_message', trans('alerts.general.success_edit'));
        return redirect()->route('admin.merchants.commissions.show',$merchant_commission_id);
    }

    public function destroy($merchant_commission_id, $id)
    {
        //
        try {
            $data = $this->merchantCommissionItemRepository->destroy($id);
            event(new UserModifiedEvent($data, Events::DELETED));
            session()->flash('flash_message', trans('alerts.general.success_delete'));
            return redirect()->route('admin.merchants.commissions.show',$merchant_commission_id);
        } catch (Exception $e) {
            session()->flash('flash_message_error', trans('errorMessages.errors.try_errors.' . $e->getCode()));
            return redirect()->route('admin.merchants.commissions.show', $merchant_commission_id);
        }
    }
}