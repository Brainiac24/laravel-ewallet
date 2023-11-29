<?php
/**
 * Created by PhpStorm.
 * User: Ladmin
 * Date: 17.12.2019
 * Time: 10:22
 */

namespace App\Http\Controllers\Backend\Web\Merchant\MerchantCategory;


use App\Events\Backend\User\UserHistory\UserModifiedEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Web\Merchant\MerchantCategory\StoreMerchantCategoryRequest;
use App\Http\Requests\Backend\Web\Merchant\MerchantCategory\UpdateMerchantCategoryRequest;
use App\Repositories\Backend\Merchant\MerchantCategory\MerchantCategoryRepositoryContract;
use App\Services\Common\Helpers\Events;
use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;

class MerchantCategoryController extends Controller
{
    /**
     * @var MerchantCategoryRepositoryContract
     */
    private $merchantCategoryRepository;

    /**
     * MerchantCategoryController constructor.
     * @param MerchantCategoryRepositoryContract $merchantCategoryRepository
     */
    public function __construct(MerchantCategoryRepositoryContract $merchantCategoryRepository)
    {
        $this->middleware('merchant.category.can-list', ['only' => ['index']]);
        $this->middleware('merchant.category.can-show', ['only' => ['show']]);
        $this->middleware('merchant.category.can-create', ['only' => ['create', 'store']]);
        $this->middleware('merchant.category.can-edit', ['only' => ['edit', 'update']]);
        $this->middleware('merchant.category.can-delete', ['only' => ['destroy']]);

        $this->merchantCategoryRepository = $merchantCategoryRepository;
    }

    public function Index()
    {
        $data = $this->merchantCategoryRepository->all();
        return view('backend.merchant.merchantCategory.index', compact('data'));
    }

    public function show($id)
    {
        //
        $data = $this->merchantCategoryRepository->findById($id);

        Breadcrumbs::setCurrentRoute('admin.merchants.categories.show', $data);
        return view('backend.merchant.merchantCategory.show', compact('data'));
    }

    public function create()
    {
        //
        $data = $this->merchantCategoryRepository->all()->pluck('name', 'id');
        return view('backend.merchant.merchantCategory.create', compact('data'));
    }

    public function store(StoreMerchantCategoryRequest $request)
    {
        //
        $data = $request->validated();
        $merchant = $this->merchantCategoryRepository->create($data);
        $merchant->setChanges($merchant->getAttributes());
        event(new UserModifiedEvent($merchant, Events::CREATED));
        session()->flash('flash_message', trans('alerts.general.success_add'));
        return redirect()->route('admin.merchants.categories.index');
    }

    public function edit($id)
    {
        $data = $this->merchantCategoryRepository->findById($id);

        Breadcrumbs::setCurrentRoute('admin.merchants.categories.edit', $data);
        return view('backend.merchant.merchantCategory.edit', compact('data'));
    }

    public function update(UpdateMerchantCategoryRequest $request, $id)
    {
        //
        $data = $this->merchantCategoryRepository->update($request->validated(), $id);

        event(new UserModifiedEvent($data, Events::UPDATED));
        session()->flash('flash_message', trans('alerts.general.success_edit'));
        return redirect()->route('admin.merchants.categories.index');
    }

    public function destroy($id)
    {
        //
        try {
            $data = $this->merchantCategoryRepository->destroy($id);
            event(new UserModifiedEvent($data, Events::DELETED));
            session()->flash('flash_message', trans('alerts.general.success_delete'));
            return redirect()->route('admin.merchants.categories.index');
        } catch (\Exception $e) {
            session()->flash('flash_message_error', trans('errorMessages.errors.try_errors.' . $e->getCode()));
            return redirect()->route('admin.merchants.categories.index');
        }
    }
}