<?php
/**
 * Created by PhpStorm.
 * User: F_Kosimov
 * Date: 18.07.2018
 * Time: 14:31
 */

namespace App\Http\Controllers\Backend\Web\Gateway;

use App\Events\Backend\User\UserHistory\UserModifiedEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Web\Gateway\IndexGatewayRequest;
use App\Http\Requests\Backend\Web\Gateway\StoreGatewayRequest;
use App\Http\Requests\Backend\Web\Gateway\UpdateGatewayRequest;
use App\Repositories\Backend\Gateway\GatewayRepositoryContract;
use App\Services\Common\Helpers\Events;
use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;

class GatewayController extends Controller
{
    protected $gatewayRepository;

    public function __construct(GatewayRepositoryContract $gatewayRepository)
    {
        $this->gatewayRepository = $gatewayRepository;
        $this->middleware('gateway.can-manage');
    }

    public function index(IndexGatewayRequest $request)
    {
        $data = $request->validated();
        $gateways = $this->gatewayRepository->all($data);
        return view('backend.gateway.index', compact('gateways', 'data'));
    }

    public function create()
    {
        return view('backend.gateway.create');
    }

    public function edit($id)
    {
        $gateway = $this->gatewayRepository->findById($id);
        Breadcrumbs::setCurrentRoute('admin.gateways.edit', $gateway);
        return view('backend.gateway.edit', compact('gateway'));
    }

    public function show($id)
    {
        $gateway = $this->gatewayRepository->findById($id);
        Breadcrumbs::setCurrentRoute('admin.gateways.show', $gateway);
        return view('backend.gateway.show', compact('gateway'));
    }
    public function destroy($id)
    {
        try {
            $gateway = $this->gatewayRepository->destroy($id);
            event(new UserModifiedEvent($gateway, Events::DELETED));
            session()->flash('flash_message', trans('alerts.general.success_delete'));
            return redirect()->route('admin.gateways.index');
        } catch (\Exception $e) {
            session()->flash('flash_message_error', trans('errorMessages.errors.try_errors.' . $e->getCode()));
            return redirect()->route('admin.gateways.index');
        }
    }
    public function store(StoreGatewayRequest $request)
    {
        $gateway = $this->gatewayRepository->create($request->validated());
        $gateway->setChanges($gateway->getAttributes());
        event(new UserModifiedEvent($gateway, Events::CREATED));
        session()->flash('flash_message', trans('alerts.general.success_add'));
        return redirect()->route('admin.gateways.index');
    }

    public function update(UpdateGatewayRequest $request, $id)
    {
        $gateway = $this->gatewayRepository->update($request->validated(), $id);
        event(new UserModifiedEvent($gateway, Events::UPDATED));
        session()->flash('flash_message', trans('alerts.general.success_edit'));
        return redirect()->route('admin.gateways.index');
    }
}
