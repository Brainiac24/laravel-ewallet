<?php
/**
 * Created by PhpStorm.
 * User: Ladmin
 * Date: 17.12.2019
 * Time: 15:47
 */

namespace App\Http\Controllers\Backend\Web\Merchant\MerchantWorkdays;


use App\Events\Backend\User\UserHistory\UserModifiedEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Web\Merchant\MerchantWorkdays\StoreMerchantWorkdaysRequest;
use App\Http\Requests\Backend\Web\Merchant\MerchantWorkdays\UpdateMerchantWorkdaysRequest;
use App\Repositories\Backend\Merchant\MerchantWorkdays\MerchantWorkdaysRepositoryContract;
use App\Services\Common\Helpers\Events;
use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;

class MerchantWorkdaysController extends Controller
{
    /**
     * @var MerchantWorkdaysRepositoryContract
     */
    private $merchantWorkdaysRepository;

    /**
     * MerchantWorkdaysController constructor.
     * @param MerchantWorkdaysRepositoryContract $merchantWorkdaysRepository
     */
    public function __construct(MerchantWorkdaysRepositoryContract $merchantWorkdaysRepository)
    {
        $this->middleware('merchant.workdays.can-list', ['only' => ['index']]);
        $this->middleware('merchant.workdays.can-show', ['only' => ['show']]);
        $this->middleware('merchant.workdays.can-create', ['only' => ['create', 'store']]);
        $this->middleware('merchant.workdays.can-edit', ['only' => ['edit', 'update']]);
        $this->middleware('merchant.workdays.can-delete', ['only' => ['destroy']]);

        $this->merchantWorkdaysRepository = $merchantWorkdaysRepository;
    }

    public function Index()
    {
        $data = $this->merchantWorkdaysRepository->all('');
        return view('backend.merchant.merchantWorkdays.index', compact('data'));
    }

    public function show($id)
    {
        //
        $data = $this->merchantWorkdaysRepository->findById($id);

        Breadcrumbs::setCurrentRoute('admin.merchants.merchantWorkdays.show', $data);
        return view('backend.merchant.merchantWorkdays.show', compact('data'));
    }

    public function create()
    {
        //
        $data = $this->merchantWorkdaysRepository->all('')->pluck('name', 'id');
        return view('backend.merchant.merchantWorkdays.create', compact('data'));
    }

    public function store(StoreMerchantWorkdaysRequest $request)
    {
        //
        $data = $request->validated();
        $merchantWorkdays = $this->merchantWorkdaysRepository->create($data);
        $merchantWorkdays->setChanges($merchantWorkdays->getAttributes());
        event(new UserModifiedEvent($merchantWorkdays, Events::CREATED));
        session()->flash('flash_message', trans('alerts.general.success_add'));
        return redirect()->route('admin.merchants.merchantWorkdays.index');
    }

    public function edit($id)
    {
        $data = $this->merchantWorkdaysRepository->findById($id);

        Breadcrumbs::setCurrentRoute('admin.merchants.merchantWorkdays.edit', $data);
        return view('backend.merchant.merchantWorkdays.edit', compact('data'));
    }

    public function update(UpdateMerchantWorkdaysRequest $request, $id)
    {
        //
        $data = $this->merchantWorkdaysRepository->update($request->validated(), $id);

        event(new UserModifiedEvent($data, Events::UPDATED));
        session()->flash('flash_message', trans('alerts.general.success_edit'));
        return redirect()->route('admin.merchants.merchantWorkdays.index');
    }

//    public function destroy($id)
//    {
//        //
//        try {
//            $data = $this->merchantWorkdaysRepository->destroy($id);
//            event(new UserModifiedEvent($data, Events::DELETED));
//            session()->flash('flash_message', trans('alerts.general.success_delete'));
//            return redirect()->route('admin.merchants.merchantWorkdays.index');
//        } catch (\Exception $e) {
//            session()->flash('flash_message_error', trans('errorMessages.errors.try_errors.' . $e->getCode()));
//            return redirect()->route('admin.merchants.merchantWorkdays.index');
//        }
//    }
}