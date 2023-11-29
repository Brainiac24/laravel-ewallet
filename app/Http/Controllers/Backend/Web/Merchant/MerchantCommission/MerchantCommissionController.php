<?php
/**
 * Created by PhpStorm.
 * User: Ladmin
 * Date: 24.02.2020
 * Time: 10:46
 */

namespace App\Http\Controllers\Backend\Web\Merchant\MerchantCommission;


use App\Events\Backend\User\UserHistory\UserModifiedEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Web\Merchant\MerchantCommission\IndexMerchantCommissionRequest;
use App\Http\Requests\Backend\Web\Merchant\MerchantCommission\StoreMerchantCommissionRequest;
use App\Http\Requests\Backend\Web\Merchant\MerchantCommission\UpdateMerchantCommissionRequest;
use App\Repositories\Backend\Merchant\MerchantCommission\MerchantCommissionRepositoryContract;
use App\Repositories\Backend\Merchant\MerchantCommissionItem\MerchantCommissionItemRepositoryContract;
use App\Services\Common\Helpers\Events;
use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;

class MerchantCommissionController extends Controller
{
    /**
     * @var MerchantCommissionRepositoryContract
     */
    private $merchantCommissionRepository;
    /**
     * @var MerchantCommissionItemRepositoryContract
     */
    private $merchantCommissionItemRepository;

    /**
     * MerchantCommissionController constructor.
     * @param MerchantCommissionRepositoryContract $commissionRepository
     * @param MerchantCommissionItemRepositoryContract $merchantCommissionItemRepository
     */
    public function __construct(MerchantCommissionRepositoryContract $commissionRepository, MerchantCommissionItemRepositoryContract $merchantCommissionItemRepository)
    {

        $this->merchantCommissionRepository = $commissionRepository;

        $this->middleware('merchant.commission.can-list', ['only' => ['index']]);
        $this->middleware('merchant.commission.can-show', ['only' => ['show']]);
        $this->middleware('merchant.commission.can-create', ['only' => ['create', 'store']]);
        $this->middleware('merchant.commission.can-edit', ['only' => ['edit', 'update']]);
        $this->middleware('merchant.commission.can-delete', ['only' => ['destroy']]);
        $this->merchantCommissionItemRepository = $merchantCommissionItemRepository;
    }

    public function Index(IndexMerchantCommissionRequest $request)
    {
        $data=$request->validated();
        $merchantCommissions = $this->merchantCommissionRepository->paginate($data);
        $merchantCommissions->appends($data);

        return view('backend.merchant.merchantCommission.index', compact('merchantCommissions','data'));
    }

    public function show($id)
    {
        //
        $data = $this->merchantCommissionRepository->findById($id);
        $merchantCommissionItems = $this->merchantCommissionItemRepository->GetAllMerchantCommissionById($id);
        //dd($merchantCommissionItems);
        Breadcrumbs::setCurrentRoute('admin.merchants.commissions.show', $data);
        return view('backend.merchant.merchantCommission.show', compact('data','merchantCommissionItems'));
    }

    public function create()
    {
        //
        $data = $this->merchantCommissionRepository->all('')->pluck('name', 'id');
        return view('backend.merchant.merchantCommission.create', compact('data'));
    }

    public function store(StoreMerchantCommissionRequest $request)
    {
        //
        $data = $request->validated();
        $merchantCommission = $this->merchantCommissionRepository->create($data);
        $merchantCommission->setChanges($merchantCommission->getAttributes());
        event(new UserModifiedEvent($merchantCommission, Events::CREATED));
        session()->flash('flash_message', trans('alerts.general.success_add'));
        return redirect()->route('admin.merchants.commissions.index');
    }

    public function edit($id)
    {
        $data = $this->merchantCommissionRepository->findById($id);

        Breadcrumbs::setCurrentRoute('admin.merchants.commissions.edit', $data);
        return view('backend.merchant.merchantCommission.edit', compact('data'));
    }

    public function update(UpdateMerchantCommissionRequest $request, $id)
    {
        //
        $data = $this->merchantCommissionRepository->update($request->validated(), $id);

        event(new UserModifiedEvent($data, Events::UPDATED));
        session()->flash('flash_message', trans('alerts.general.success_edit'));
        return redirect()->route('admin.merchants.commissions.index');
    }

    public function destroy($id)
    {
        //
        try {
            $data = $this->merchantCommissionRepository->destroy($id);
            event(new UserModifiedEvent($data, Events::DELETED));
            session()->flash('flash_message', trans('alerts.general.success_delete'));
            return redirect()->route('admin.merchants.commissions.index');
        } catch (Exception $e) {
            session()->flash('flash_message_error', trans('errorMessages.errors.try_errors.' . $e->getCode()));
            return redirect()->route('admin.merchants.commissions.index');
        }
    }
}