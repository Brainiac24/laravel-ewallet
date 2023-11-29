<?php
/**
 * Created by PhpStorm.
 * User: F_Kosimov
 * Date: 18.07.2018
 * Time: 14:31
 */

namespace App\Http\Controllers\Backend\Web\Service\WorkDays;

use App\Events\Backend\User\UserHistory\UserModifiedEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Web\Service\WorkDays\StoreServiceWorkdaysRequest;
use App\Http\Requests\Backend\Web\Service\WorkDays\UpdateServiceWorkdaysRequest;
use App\Repositories\Backend\Service\WorkDays\ServiceWorkdaysRepositoryContract;
use App\Services\Common\Helpers\Events;
use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;

class ServiceWorkDaysController extends Controller
{
    protected $ServiceWorkDaysRepository;

    public function __construct(ServiceWorkdaysRepositoryContract $ServiceWorkDaysRepository)
    {
        $this->ServiceWorkDaysRepository = $ServiceWorkDaysRepository;
        $this->middleware('service.workday.can-list', ['only' => ['index']]);
        $this->middleware('service.workday.can-show', ['only' => ['show']]);
        $this->middleware('service.workday.can-create', ['only' => ['create','store']]);
        $this->middleware('service.workday.can-edit', ['only' => ['edit','update']]);
        $this->middleware('service.workday.can-delete', ['only' => ['destroy']]);
    }
    public function index()
    {
        $serviceWorkDays = $this->ServiceWorkDaysRepository->all();
        return view('backend.service.WorkDays.index',compact('serviceWorkDays'));
    }

    public function create()
    {
        return view('backend.service.WorkDays.create');
    }

    public function edit($id)
    {
        $serviceWorkDays = $this->ServiceWorkDaysRepository->findById($id);
        Breadcrumbs::setCurrentRoute('admin.workdays.edit', $serviceWorkDays);
        return view('backend.service.WorkDays.edit',compact('serviceWorkDays'));
    }

    public function show($id)
    {
        $serviceWorkDays = $this->ServiceWorkDaysRepository->findById($id);
        Breadcrumbs::setCurrentRoute('admin.workdays.show', $serviceWorkDays);
        return view('backend.service.WorkDays.show',compact('serviceWorkDays'));
    }

    public function destroy($id)
    {
        $serviceWorkDays = $this->ServiceWorkDaysRepository->destroy($id);
        event(new UserModifiedEvent($serviceWorkDays, Events::DELETED));
        session()->flash('flash_message', trans('alerts.general.success_delete'));
        return redirect()->route('admin.workdays.index');
    }
    public function store(StoreServiceWorkdaysRequest $request)
    {
        $serviceWorkDays = $this->ServiceWorkDaysRepository->create($request->validated());
        $serviceWorkDays->setChanges($serviceWorkDays->getAttributes());
        event(new UserModifiedEvent($serviceWorkDays, Events::CREATED));
        session()->flash('flash_message', trans('alerts.general.success_add'));
        return redirect()->route('admin.workdays.index');
    }
    public function update(UpdateServiceWorkdaysRequest $request, $id)
    {
        $serviceWorkDays = $this->ServiceWorkDaysRepository->update($request->validated(), $id);
        event(new UserModifiedEvent($serviceWorkDays, Events::UPDATED));
        session()->flash('flash_message', trans('alerts.general.success_edit'));
        return redirect()->route('admin.workdays.index');
    }


}