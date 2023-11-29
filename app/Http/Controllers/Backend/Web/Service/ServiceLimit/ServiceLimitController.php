<?php
/**
 * Created by PhpStorm.
 * User: F_Kosimov
 * Date: 18.07.2018
 * Time: 14:31
 */

namespace App\Http\Controllers\Backend\Web\Service\ServiceLimit;

use App\Events\Backend\User\UserHistory\UserModifiedEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Web\Service\ServiceLimits\StoreServiceLimitRequest;
use App\Http\Requests\Backend\Web\Service\ServiceLimits\UpdateServiceLimitsRequest;
use App\Repositories\Backend\Service\ServiceLimit\ServiceLimitRepositoryContract;
use App\Services\Common\Helpers\Events;
use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;

class ServiceLimitController extends Controller
{
    protected $serviceLimit;

    public function __construct(ServiceLimitRepositoryContract $serviceLimit)
    {
        $this->serviceLimit = $serviceLimit;
        $this->middleware('service.limit.can-list', ['only' => ['index']]);
        $this->middleware('service.limit.can-show', ['only' => ['show']]);
        $this->middleware('service.limit.can-create', ['only' => ['create','store']]);
        $this->middleware('service.limit.can-edit', ['only' => ['edit','update']]);
        $this->middleware('service.limit.can-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $serviceLimits = $this->serviceLimit->all();
        return view('backend.serviceLimits.index',compact('serviceLimits'));
    }

    public function create()
    {
        return view('backend.serviceLimits.create');
    }

    public function edit($id)
    {
        $serviceLimit = $this->serviceLimit->findById($id);
        Breadcrumbs::setCurrentRoute('admin.limits.edit', $serviceLimit);
        return view('backend.serviceLimits.edit',compact('serviceLimit'));
    }

    public function show($id)
    {
        $serviceLimit = $this->serviceLimit->findById($id);
        Breadcrumbs::setCurrentRoute('admin.limits.show', $serviceLimit);
        return view('backend.serviceLimits.show',compact('serviceLimit'));
    }

    public function destroy($id)
    {
        $serviceLimit = $this->serviceLimit->destroy($id);
        event(new UserModifiedEvent($serviceLimit, Events::DELETED));
        session()->flash('flash_message', trans('alerts.general.success_delete'));
        return redirect()->route('admin.limits.index');
    }

    public function store(StoreServiceLimitRequest $request)
    {
        //dd('1');
        $serviceLimit = $this->serviceLimit->create($request->validated());
        $serviceLimit->setChanges($serviceLimit->getAttributes());
        event(new UserModifiedEvent($serviceLimit, Events::CREATED));
        session()->flash('flash_message', trans('alerts.general.success_add'));
        return redirect()->route('admin.limits.index');
    }

    public function update(UpdateServiceLimitsRequest $request, $id)
    {
        $serviceLimit = $this->serviceLimit->update($request->validated(), $id);
        event(new UserModifiedEvent($serviceLimit, Events::UPDATED));
        session()->flash('flash_message', trans('alerts.general.success_edit'));
        return redirect()->route('admin.limits.index');
    }
}