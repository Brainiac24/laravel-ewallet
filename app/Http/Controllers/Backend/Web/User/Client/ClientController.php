<?php

namespace App\Http\Controllers\Backend\Web\User\Client;


use App\Http\Requests\Backend\Web\User\Client\UpadateLiteRequest;
use Carbon\Carbon;
use App\Exports\Client\ClientExport;
use App\Http\Controllers\Controller;
use App\Services\Common\Helpers\Events;
use App\Services\Common\Helpers\Helper;
use App\Services\Common\Helpers\Service;
use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;
use App\Http\Requests\Backend\Web\User\StoreUserRequest;
use App\Http\Requests\Backend\Web\User\UpdateUserRequest;
use App\Repositories\Backend\Area\AreaRepositoryContract;
use App\Repositories\Backend\City\CityRepositoryContract;
use App\Events\Backend\User\UserHistory\UserModifiedEvent;
use App\Repositories\Backend\Region\RegionRepositoryContract;
use App\Repositories\Backend\Account\AccountRepositoryContract;
use App\Repositories\Backend\Country\CountryRepositoryContract;
use App\Http\Requests\Backend\Web\User\Client\SearchClientRequest;
use App\Repositories\Backend\User\Client\ClientRepositoryContract;
use App\Http\Requests\Backend\Web\User\Client\AddCodeMapClientRequest;
use App\Http\Requests\Backend\Web\User\Client\IdentificateClientRequest;
use App\Repositories\Backend\User\Attestation\AttestationRepositoryContract;
use App\Repositories\Backend\User\UserHistory\UserHistoryRepositoryContract;
use App\Repositories\Backend\User\UserSession\UserSessionRepositoryContract;
use App\Services\Backend\Web\ExportJob\ClientExportJob\ClientExportJobServiceContract;
use App\Repositories\Backend\User\DocumentType\DocumentTypeRepositoryContract;

class ClientController extends Controller
{
    protected $clientRepository;
    protected $user;
    protected $accountRepository;
    protected $clientHistory;
    protected $attestationRepository;

    public $countryRepository;
    public $regionRepository;
    public $areaRepository;
    public $cityRepository;
    public $documentTypeRepository;
    /**
     * @var UserSessionRepositoryContract
     */
    private $userSessionRepositoryContract;

    private $clientExportJobService;

    public function __construct(ClientRepositoryContract $clientRepository,
                                AccountRepositoryContract $accountRepository,
                                UserHistoryRepositoryContract $clientHistory,
                                CountryRepositoryContract $countryRepository,
                                RegionRepositoryContract $regionRepository,
                                AreaRepositoryContract $areaRepository,
                                CityRepositoryContract $cityRepository,
                                DocumentTypeRepositoryContract $documentTypeRepository,
                                AttestationRepositoryContract $attestationRepository,
                                ClientExportJobServiceContract $clientExportJobService
    )
    {
        $this->clientRepository = $clientRepository;
        $this->accountRepository = $accountRepository;
        $this->clientHistory = $clientHistory;

        $this->documentTypeRepository = $documentTypeRepository;
        $this->countryRepository = $countryRepository;
        $this->regionRepository = $regionRepository;
        $this->areaRepository = $areaRepository;
        $this->cityRepository = $cityRepository;
        $this->attestationRepository = $attestationRepository;
        $this->clientExportJobService = $clientExportJobService;

        $this->middleware('client.can-show-list', ['only' => ['index']]);
        $this->middleware('client.can-show-detail', ['only' => ['show']]);
        //$this->middleware('client.can-create', ['only' => ['create', 'store']]);
        $this->middleware('client.can-edit', ['only' => ['edit', 'update']]);
        $this->middleware('client.can-lockManage', ['only' => ['block']]);
        $this->middleware('client.can-unlockManage', ['only' => ['unlock']]);
        $this->middleware('client.can-delete-email', ['only' => ['deleteEmail']]);
        $this->middleware('client.can-identificate', ['only' => ['identificateEdit']]);
        $this->middleware('client.can-updateLite', ['only' => ['updateLite']]);
        $this->middleware('client.can-identificate-for-admin', ['only' => ['identificate']]);
        $this->middleware('client.can-addCodeMap', ['only' => ['addCodeMap']]);
        $this->middleware('client.can-deleteCodeMap', ['only' => ['deleteCodeMap', 'resetIdentification']]);
        $this->middleware('client.can-resetPassword', ['only' => ['resetPassword']]);
        $this->middleware('client.can-delete-pin', ['only' => ['deletePin']]);
    }

    public function index(SearchClientRequest $request)
    {
        $data = $request->validated();
        if ($request->export ?? false == true) {
            try{
                $this->clientExportJobService->create($data);
                session()->flash('flash_message', "Задача для формирование отчета создано. Вы сможете найти свою выгрузку в разделе \"Задачи\"");
                return redirect()->route('admin.clients.index');
            }catch (\Exception $e)
            {
                session()->flash('flash_message_error', $e->getMessage());
                return redirect()->route('admin.clients.index');
            }
        } else {

            $clients = $this->clientRepository->paginate($data);
            $attestations = $this->attestationRepository->listsAll()->prepend('', '');

            $clients->appends($request->validated());
            return view('backend.user.client.index', compact('clients', 'data', 'attestations'));
        }
    }

    /*public function create()
    {
        return view('backend.user.client.create');
    }*/

    public function edit($id)
    {
        $client = $this->clientRepository->findById($id);
        //dd($client);
        $account = $this->accountRepository->findWalletByUserId($id);

        $userHistory = null;
        if (\Auth::user()->ability('sadmin', 'client-histories')) {
            $userHistory = $this->clientHistory->paginateByUserId($id);
        }

        $document_type = $this->documentTypeRepository->listsAll()->prepend('', ''); //---
        //$country = $this->countryRepository->listsAll()->prepend('', '');
        $country = $this->countryRepository->all('ТАДЖИКИСТАН')->pluck('name', 'id');//getByNamePluck('ТАДЖИКИСТАН');
        //dd($country);
        $country_born = $this->countryRepository->listsAll()->prepend('', '');
        //dd($country);
        $region = $this->regionRepository->listsAll()->prepend('', ''); //---
        $area = $this->areaRepository->listsAll()->prepend('', ''); //---
        $city = $this->cityRepository->listsAll()->prepend('', ''); //---

        $block_result = false;
        $now = Carbon::now();

        if ($now->diffInSeconds($client->unblock_at, false) > 0 || $client->is_active == false) {
            $block_result = true;
        }

        $qr_code = [
            "v" => 1,
            "srv" => [
                "id" => Service::EWALLET_ESKHATA,
                "attr" => [
                    "to_account" => $client->msisdn
                ]
            ],
            "service_id" => Service::EWALLET_ESKHATA,
            "phone" => substr($client->msisdn, 3, strlen($client->msisdn) - 3)
        ];

        $qr_code_base64 = base64_encode(json_encode($qr_code));
        $qr_photo_base64 = Helper::generateQrCodeWithBase64($qr_code_base64);

        $documentCreateDate = null;

        if(isset($client->contacts_json['documentCreateDate']))
        {
            try {
                $documentCreateDate = \Carbon\Carbon::parse($client->contacts_json['documentCreateDate'])->format('Y-m-d');
            }catch (\Exception $e)
            {
                if (preg_match("/(\d{2})\/(\d{2})\/(\d{4})$/", $client->contacts_json['documentCreateDate']))
                {
                    $documentCreateDate = \Carbon\Carbon::createFromFormat("d/m/Y",$client->contacts_json['documentCreateDate'])->format('Y-m-d');
                }
                elseif(preg_match("/(\d{2}).(\d{2}).(\d{4})$/", $client->contacts_json['documentCreateDate']))
                {
                    $documentCreateDate = \Carbon\Carbon::createFromFormat("d.m.Y",$client->contacts_json['documentCreateDate'])->format('Y-m-d');
                }
                elseif(preg_match("/(\d{2})-(\d{2})-(\d{4})$/", $client->contacts_json['documentCreateDate']))
                {
                    $documentCreateDate = \Carbon\Carbon::createFromFormat("d-m-Y",$client->contacts_json['documentCreateDate'])->format('Y-m-d');
                }
            }
        }

        Breadcrumbs::setCurrentRoute('admin.clients.edit', $client);
        return view('backend.user.client.edit', compact('client', 'account', 'userHistory', 'block_result', 'document_type', 'country', 'country_born', 'region', 'area', 'city', 'qr_code_base64', 'qr_photo_base64','documentCreateDate'));
    }

    public function show($id)
    {
        $client = $this->clientRepository->findById($id);
        Breadcrumbs::setCurrentRoute('admin.clients.show', $client);
        return view('backend.user.client.show', compact('client', 'userHistories'));
    }

    public function destroy($id)
    {
        try {
            $client = $this->clientRepository->destroy($id);
            event(new UserModifiedEvent($client, Events::DELETED));
            session()->flash('flash_message', trans('alerts.general.success_delete'));
            return redirect()->route('admin.clients.index');
        } catch (\Exception $e) {
            session()->flash('flash_message_error', trans('errorMessages.errors.try_errors.' . $e->getCode()));
            return redirect()->route('admin.clients.index');
        }
    }

    public function unlock($id)
    {
        try {
            $client = $this->clientRepository->unlock($id);
            event(new UserModifiedEvent($client, Events::UPDATED));
            session()->flash('flash_message', trans('alerts.general.success_delete'));
            return redirect()->route('admin.clients.edit', $id);
        } catch (\Exception $e) {
            session()->flash('flash_message_error', trans('errorMessages.errors.try_errors.' . $e->getCode()));
            return redirect()->route('admin.clients.edit', $id);
        }
    }

    public function deleteEmail($id)
    {
        try {
            $client = $this->clientRepository->deleteEmail($id);
            event(new UserModifiedEvent($client, Events::UPDATED));
            session()->flash('flash_message', trans('alerts.general.success_delete'));
            return redirect()->route('admin.clients.edit', $id);
        } catch (\Exception $e) {
            session()->flash('flash_message_error', trans('errorMessages.errors.try_errors.' . $e->getCode()));
            return redirect()->route('admin.clients.edit', $id);
        }
    }

    public function identificate(IdentificateClientRequest $request, $id)
    {
        //dd($request);
        try {
            $client = $this->clientRepository->identificate($request->validated(), $id);
            event(new UserModifiedEvent($client, Events::UPDATED));
            session()->flash('flash_message', trans('alerts.general.success_identificate'));
            return redirect()->route('admin.clients.edit', $request->id);
        } catch (\Exception $e) {
            session()->flash('flash_message_error', trans('errorMessages.errors.try_errors.' . $e->getCode()));
            return redirect()->route('admin.clients.edit', $request->id);
        }
    }

    public function identificateEdit(IdentificateClientRequest $request, $id)
    {
        //dd($request);
        try {
            $client = $this->clientRepository->identificateEdit($request->validated(), $id);
            event(new UserModifiedEvent($client, Events::UPDATED));
            session()->flash('flash_message', trans('alerts.general.success_identificate'));
            return redirect()->route('admin.clients.edit', $request->id);
        } catch (\Exception $e) {
            session()->flash('flash_message_error', trans('errorMessages.errors.try_errors.' . $e->getCode()));
            return redirect()->route('admin.clients.edit', $request->id);
        }
    }

    public function updateLite(UpadateLiteRequest $request, $id)
    {
        try {
            $client = $this->clientRepository->updateLite($request->validated(), $id);
            event(new UserModifiedEvent($client, Events::UPDATED));
            session()->flash('flash_message', trans('alerts.general.success_edit'));
            return redirect()->route('admin.clients.edit', $request->id);
        } catch (\Exception $e) {
            session()->flash('flash_message_error', trans('errorMessages.errors.try_errors.' . $e->getCode()));
            return redirect()->route('admin.clients.edit', $request->id);
        }
    }

    public function block($id)
    {
        try {
            $client = $this->clientRepository->block($id);
            event(new UserModifiedEvent($client, Events::UPDATED));
            session()->flash('flash_message', trans('alerts.general.success_delete'));
            return redirect()->route('admin.clients.edit', $id);
        } catch (\Exception $e) {
            session()->flash('flash_message_error', trans('errorMessages.errors.try_errors.' . $e->getCode()));
            return redirect()->route('admin.clients.edit', $id);
        }
    }

    public function addCodeMap(AddCodeMapClientRequest $request, $id)
    {
        try {
            $client = $this->clientRepository->addCodeMap($id, $request->code_map);
            event(new UserModifiedEvent($client, Events::UPDATED));
            session()->flash('flash_message', trans('alerts.general.success_edit'));
            return redirect()->route('admin.clients.edit', $id);
        } catch (\Exception $e) {
            session()->flash('flash_message_error', trans('errorMessages.errors.try_errors.' . $e->getCode()));
            return redirect()->route('admin.clients.edit', $id);
        }
    }

    public function deleteCodeMap($id)
    {
        //dd($id);
        try {
            $client = $this->clientRepository->deleteCodeMap($id);
            event(new UserModifiedEvent($client, Events::UPDATED));
            session()->flash('flash_message', trans('alerts.general.success_delete'));
            return redirect()->route('admin.clients.edit', $id);
        } catch (\Exception $e) {
            session()->flash('flash_message_error', trans('errorMessages.errors.try_errors.' . $e->getCode()));
            return redirect()->route('admin.clients.edit', $id);
        }
    }

    public function resetPassword($id)
    {
        try {
            $client = $this->clientRepository->resetPassword($id);
            event(new UserModifiedEvent($client, Events::UPDATED));
            session()->flash('flash_message', trans('alerts.general.success_delete'));
            return redirect()->route('admin.clients.edit', $id);
        } catch (\Exception $e) {
            session()->flash('flash_message_error', trans('errorMessages.errors.try_errors.' . $e->getCode()));
            return redirect()->route('admin.clients.edit', $id);
        }
    }

    public function resetIdentification($id)
    {
        try {
            $client = $this->clientRepository->resetIdentification($id);
            event(new UserModifiedEvent($client, Events::UPDATED));
            session()->flash('flash_message', trans('alerts.general.success_delete_identification'));
            return redirect()->route('admin.clients.edit', $id);
        } catch (\Exception $e) {
            session()->flash('flash_message_error', trans('errorMessages.errors.try_errors.' . $e->getCode()));
            return redirect()->route('admin.clients.edit', $id);
        }
    }

    /*public function store(StoreUserRequest $request)
    {
        $client = $this->clientRepository->create($request->validated());
        $client->setChanges($client->getAttributes());
        event(new UserModifiedEvent($client, Events::CREATED));
        session()->flash('flash_message', trans('alerts.general.success_add'));
        return redirect()->route('admin.clients.index');
    }*/

    public function update(UpdateUserRequest $request, $id)
    {

        $client = $this->clientRepository->update($request->validated(), $id);
        event(new UserModifiedEvent($client, Events::UPDATED));
        session()->flash('flash_message', trans('alerts.general.success_edit'));
        return redirect()->route('admin.clients.index');
    }

    public function citiesList()
    {
        $city = $this->cityRepository->listsAll()->prepend('', '');
        return \response()->apiError(compact('city'));
    }

    public function deletePin($id)
    {
        try {
            $client = $this->clientRepository->deletePin($id);
            event(new UserModifiedEvent($client, Events::UPDATED));
            session()->flash('flash_message', trans('alerts.general.success_delete'));
            return redirect()->route('admin.clients.edit', $id);
        } catch (\Exception $e) {
            session()->flash('flash_message_error', $e->getMessage());
            \Log::error($e->getMessage());
            \Log::error($e->getTraceAsString());
            return redirect()->route('admin.clients.edit', $id);
        }
    }
}
