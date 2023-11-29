<?php
/**
 * Created by PhpStorm.
 * User: Ladmin
 * Date: 11.10.2019
 * Time: 9:40
 */

namespace App\Http\Controllers\Backend\Web\Service\ServiceOtpLimit;


use App\Events\Backend\User\UserHistory\UserModifiedEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Web\Service\ServiceOtpLimits\IndexServiceOtpLimitRequest;
use App\Http\Requests\Backend\Web\Service\ServiceOtpLimits\StoreServiceOtpLimitRequest;
use App\Http\Requests\Backend\Web\Service\ServiceOtpLimits\UpdateServiceOtpLimitRequest;
use App\Repositories\Backend\Service\ServiceOtpLimit\ServiceOtpLimitRepositoryContract;
use App\Services\Common\Helpers\Events;
use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;

class ServiceOtpLimitController extends Controller
{
    /**
     * @var ServiceOtpLimitRepositoryContract
     */
    private $otpLimitRepositoryContract;

    public function __construct(ServiceOtpLimitRepositoryContract  $otpLimitRepositoryContract)
    {

        $this->otpLimitRepositoryContract = $otpLimitRepositoryContract;
        $this->middleware('service.otp.limit.can-list', ['only' => ['index']]);
        $this->middleware('service.otp.limit.can-show', ['only' => ['show']]);
        $this->middleware('service.otp.limit.can-create', ['only' => ['create','store']]);
        $this->middleware('service.otp.limit.can-edit', ['only' => ['edit','update']]);
        $this->middleware('service.otp.limit.can-delete', ['only' => ['destroy']]);
    }

    public function index(IndexServiceOtpLimitRequest $request)
    {
        $data = $request->validated();
        $serviceOtpLimits = $this->otpLimitRepositoryContract->paginate($data);
        $serviceOtpLimits->appends($request->validated());
        return view('backend.service.serviceOtpLimits.index', compact('serviceOtpLimits', 'data'));
    }

    public function show($id)
    {
        //
        $serviceOtpLimits = $this->otpLimitRepositoryContract->findById($id);

        Breadcrumbs::setCurrentRoute('admin.serviceOtpLimits.show', $serviceOtpLimits);
        return view('backend.service.serviceOtpLimits.show', compact('serviceOtpLimits'));
    }

    public function create()
    {
        //
        $serviceOtpLimits = $this->otpLimitRepositoryContract->all('')->pluck('name', 'id');
        return view('backend.service.serviceOtpLimits.create', compact('serviceOtpLimits'));
    }

    public function store(StoreServiceOtpLimitRequest $request)
    {
        $data = $request->validated();

        $serviceOtpLimits = $this->otpLimitRepositoryContract->create($data);
        $serviceOtpLimits->setChanges($serviceOtpLimits->getAttributes());
        event(new UserModifiedEvent($serviceOtpLimits, Events::CREATED));
        session()->flash('flash_message', trans('alerts.general.success_add'));
        return redirect()->route('admin.serviceOtpLimits.index');
    }

    public function edit($id)
    {
        $serviceOtpLimits = $this->otpLimitRepositoryContract->findById($id);

        Breadcrumbs::setCurrentRoute('admin.serviceOtpLimits.edit', $serviceOtpLimits);
        return view('backend.service.serviceOtpLimits.edit', compact('serviceOtpLimits'));
    }

    public function update(UpdateServiceOtpLimitRequest $request, $id)
    {
        //
        $data = $request->validated();

        $serviceOtpLimits = $this->otpLimitRepositoryContract->update($data, $id);

        event(new UserModifiedEvent($serviceOtpLimits, Events::UPDATED));
        session()->flash('flash_message', trans('alerts.general.success_edit'));
        return redirect()->route('admin.serviceOtpLimits.index');
    }

    public function destroy($id)
    {
        //
        try {
            $serviceOtpLimits = $this->otpLimitRepositoryContract->destroy($id);
            event(new UserModifiedEvent($serviceOtpLimits, Events::DELETED));
            session()->flash('flash_message', trans('alerts.general.success_delete'));
            return redirect()->route('admin.serviceOtpLimits.index');
        } catch (\Exception $e) {
            session()->flash('flash_message_error', trans('errorMessages.errors.try_errors.' . $e->getCode()));
            return redirect()->route('admin.serviceOtpLimits.index');
        }
    }
}