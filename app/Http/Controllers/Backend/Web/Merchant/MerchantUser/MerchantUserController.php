<?php


namespace App\Http\Controllers\Backend\Web\Merchant\MerchantUser;


use App\Events\Backend\User\UserHistory\UserModifiedEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Web\Merchant\MerchantItem\UpdateMerchantItemRequest;
use App\Http\Requests\Backend\Web\Merchant\MerchantUser\IndexMerchantUserRequest;
use App\Http\Requests\Backend\Web\Merchant\MerchantUser\UpdateMerchantUserRequest;
use App\Repositories\Backend\Merchant\MerchantUser\MerchantUserRepositoryContract;
use App\Services\Common\Helpers\Events;
use App\Services\Common\Helpers\Helper;
use App\Services\Common\Helpers\Service;

class MerchantUserController extends Controller
{
    private $merchantUserRepositoryContract;
    public function __construct(MerchantUserRepositoryContract $merchantUserRepositoryContract)
    {
        $this->middleware('merchant.user.can-list', ['only' => ['index']]);
        $this->middleware('merchant.user.can-show', ['only' => ['show']]);
        $this->middleware('merchant.user.can-edit', ['only' => ['edit', 'update']]);
        $this->middleware('merchant.user.can-delete', ['only' => ['destroy']]);
        $this->merchantUserRepositoryContract=$merchantUserRepositoryContract;
    }

    public function index(IndexMerchantUserRequest $request)
    {
        $data=$request->validated();
        $merchantUsers=$this->merchantUserRepositoryContract->paginate($data);
        return view('backend.merchant.merchantUser.index', compact('data', 'merchantUsers'));
    }

    public function show($id)
    {
        $merchantUser = $this->merchantUserRepositoryContract->findById($id);
        \Breadcrumbs::setCurrentRoute('admin.merchants.users.show', $merchantUser);
        return view('backend.merchant.merchantUser.show', compact('merchantUser'));
    }

    public function edit($id)
    {
        $merchantUser = $this->merchantUserRepositoryContract->findById($id);
        \Breadcrumbs::setCurrentRoute('admin.merchants.users.edit',$merchantUser);
        return view('backend.merchant.merchantUser.edit', compact('merchantUser'));
    }

    public function update(UpdateMerchantUserRequest $request, $id)
    {
        $merchantUser = $this->merchantUserRepositoryContract->update($request->validated(), $id);
        event(new UserModifiedEvent($merchantUser, Events::UPDATED));
        session()->flash('flash_message', trans('alerts.general.success_edit'));
        return redirect()->route('admin.merchants.users.index');
    }

    public function destroy($id)
    {
        try {
            $merchantUser = $this->merchantUserRepositoryContract->destroy($id);
            event(new UserModifiedEvent($merchantUser, Events::DELETED));
            session()->flash('flash_message', trans('alerts.general.success_delete'));
            return redirect()->route('admin.merchants.users.index');
        } catch (\Exception $e) {
            session()->flash('flash_message_error', trans('errorMessages.errors.try_errors.' . $e->getCode()));
            return redirect()->route('admin.merchants.users.index');
        }
    }
}