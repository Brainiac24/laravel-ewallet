<?php
/**
 * Created by PhpStorm.
 * User: F_Kosimov
 * Date: 18.07.2018
 * Time: 14:31
 */

namespace App\Http\Controllers\Backend\Web\Service\Commission;

use App\Events\Backend\User\UserHistory\UserModifiedEvent;


use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Web\Service\Commission\DeleteCommissionDataRequest;
use App\Http\Requests\Backend\Web\Service\Commission\StoreCommissionDataRequest;
use App\Http\Requests\Backend\Web\Service\Commission\StoreCommissionRequest;
use App\Http\Requests\Backend\Web\Service\Commission\UpdateCommissionRequest;
use App\Repositories\Backend\Service\Commission\CommissionRepositoryContract;
use App\Services\Common\Helpers\Events;
use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;
use Illuminate\Support\Facades\Request;

class CommissionController extends Controller
{
    protected $commissionRepository;

    public function __construct(CommissionRepositoryContract $commissionRepository)
    {
        $this->commissionRepository = $commissionRepository;
        $this->middleware('service.commission.can-list', ['only' => ['index']]);
        $this->middleware('service.commission.can-show', ['only' => ['show']]);
        $this->middleware('service.commission.can-create', ['only' => ['create','store']]);
        $this->middleware('service.commission.can-edit', ['only' => ['edit','update']]);
        $this->middleware('service.commission.can-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $commissions = $this->commissionRepository->all();
        return view('backend.service.commission.index',compact('commissions'));
    }

    public function create()
    {
        return view('backend.service.commission.create');
    }

    public function edit($id)
    {
        $commission = $this->commissionRepository->findById($id);
        Breadcrumbs::setCurrentRoute('admin.services.commissions.edit', $commission);
        return view('backend.service.commission.edit',compact('commission'));
    }

    public function show($id)
    {
        $commission = $this->commissionRepository->findById($id);
        Breadcrumbs::setCurrentRoute('admin.services.commissions.show', $commission);
        return view('backend.service.commission.show',compact('commission'));
    }

    public function destroy($id)
    {
        try {
            $commission = $this->commissionRepository->destroy($id);
            event(new UserModifiedEvent($commission, Events::DELETED));
            session()->flash('flash_message', trans('alerts.general.success_delete'));
            return redirect()->route('admin.services.commissions.index');
        } catch (\Exception $e) {
            session()->flash('flash_message_error', trans('errorMessages.errors.try_errors.' . $e->getCode()));
            return redirect()->route('admin.services.commissions.index');
        }
    }

    public function store(StoreCommissionRequest $request)
    {
        try {
            $commission = $this->commissionRepository->create($request->validated());
            $commission->setChanges($commission->getAttributes());
            event(new UserModifiedEvent($commission, Events::CREATED));
            session()->flash('flash_message', trans('alerts.general.success_add'));
            return redirect()->route('admin.services.commissions.edit', ['commission' => $commision->id]);
        } catch (\Exception $e) {
            session()->flash('flash_message_error', trans('errorMessages.errors.try_errors.' . $e->getCode()));
            return redirect()->route('admin.services.commissions.index');
        }
    }

    public function update(UpdateCommissionRequest $request, $id)
    {
        $commission = $this->commissionRepository->update($request->validated(), $id);
        event(new UserModifiedEvent($commission, Events::UPDATED));
        session()->flash('flash_message', trans('alerts.general.success_edit'));
        return redirect()->route('admin.services.commissions.index');
    }

    public function storeCommissionData(StoreCommissionDataRequest $request, $id)
    {
        $commission = $this->commissionRepository->createDataByID($request->params, $id);
        event(new UserModifiedEvent($commission, Events::UPDATED));
        session()->flash('flash_message', trans('alerts.general.success_edit'));
        Breadcrumbs::setCurrentRoute('admin.services.commissions.edit', $commission);
        return view('backend.service.commission.edit',compact('commission'));
    }

    public function destroyCommissionData(DeleteCommissionDataRequest $request, $id)
    {
        //dd($request->validated());
        $commission = $this->commissionRepository->destroyCommissionData($request->params['id'], $id);
        event(new UserModifiedEvent($commission, Events::DELETED));
        session()->flash('flash_message', trans('alerts.general.success_delete'));
        Breadcrumbs::setCurrentRoute('admin.services.commissions.edit', $commission);
        return view('backend.service.commission.edit',compact('commission'));
    }
}