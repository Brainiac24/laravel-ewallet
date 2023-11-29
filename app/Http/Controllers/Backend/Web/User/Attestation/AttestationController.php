<?php
/**
 * Created by PhpStorm.
 * User: F_Kosimov
 * Date: 17.07.2018
 * Time: 9:16
 */

namespace App\Http\Controllers\Backend\Web\User\Attestation;

use App\Events\Backend\User\UserHistory\UserModifiedEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Web\User\Attestation\StoreAttestationRequest;
use App\Http\Requests\Backend\Web\User\Attestation\UpdateAttestationRequest;
use App\Repositories\Backend\User\Attestation\AttestationRepositoryContract;
use App\Services\Common\Helpers\Events;
use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;


class AttestationController extends Controller
{
    protected $attestationRepository;

    public function __construct(AttestationRepositoryContract $attestationRepository)
    {
        $this->attestationRepository = $attestationRepository;
        $this->middleware('attestation.can-list');
    }

    public function index()
    {
        $attestations = $this->attestationRepository->all();
        return view('backend.attestations.index',compact('attestations'));
    }

    public function create()
    {
        return view('backend.attestations.create');
    }

    public function store(StoreAttestationRequest $request)
    {
        $attestation = $this->attestationRepository->create($request->validated());
        $attestation->setChanges($attestation->getAttributes());
        event(new UserModifiedEvent($attestation, Events::CREATED));
        session()->flash('flash_message', trans('alerts.general.success_add'));
        return redirect()->route('admin.attestations.index');
    }

    public function show($id)
    {
        $attestation = $this->attestationRepository->findById($id);
        Breadcrumbs::setCurrentRoute('admin.attestations.show', $attestation);
        return view('backend.attestations.show', compact('attestation'));
    }

    public function edit($id)
    {
        $attestation = $this->attestationRepository->findById($id);
        Breadcrumbs::setCurrentRoute('admin.attestations.edit', $attestation);
        return view('backend.attestations.edit', compact('attestation'));
    }

    public function update(UpdateAttestationRequest $request, $id)
    {
        $attestation = $this->attestationRepository->update($request->validated(), $id);
        event(new UserModifiedEvent($attestation, Events::UPDATED));
        session()->flash('flash_message', trans('alerts.general.success_edit'));
        return redirect()->route('admin.attestations.index');
    }

    public function destroy($id)
    {

        try {
            $attestation = $this->attestationRepository->destroy($id);
            event(new UserModifiedEvent($attestation, Events::DELETED));
            session()->flash('flash_message', trans('alerts.general.success_delete'));
            return redirect()->route('admin.attestations.index');
        } catch (\Exception $e) {
            session()->flash('flash_message_error', trans('errorMessages.errors.try_errors.' . $e->getCode()));
            return redirect()->route('admin.attestations.index');
        }

    }
}