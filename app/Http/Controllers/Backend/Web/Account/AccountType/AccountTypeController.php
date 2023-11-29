<?php
/**
 * Created by PhpStorm.
 * User: F_Kosimov
 * Date: 18.07.2018
 * Time: 14:31
 */

namespace App\Http\Controllers\Backend\Web\Account\AccountType;

use App\Repositories\Backend\Account\AccountCategoryType\AccountCategoryTypeContract;
use App\Services\Common\Image\ImageServiceContract;
use DB;
use App\Events\Backend\User\UserHistory\UserModifiedEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Web\Account\AccountType\IndexAccountRequest;
use App\Http\Requests\Backend\Web\Account\AccountType\StoreAccountTypeRequest;
use App\Http\Requests\Backend\Web\Account\AccountType\UpdateAccountTypeRequest;
use App\Repositories\Backend\Account\AccountType\AccountTypeRepositoryContract;
use App\Repositories\Backend\Gateway\GatewayRepositoryContract;
use App\Services\Common\Helpers\Events;
use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;
use Illuminate\Support\Facades\Log;
use Ramsey\Uuid\Uuid;

class AccountTypeController extends Controller
{
    protected $accountTypeRepository;
    protected $gatewayRepository;
    protected $imageService;
    protected $accountCategoryTypeRepository;

    public function __construct(AccountTypeRepositoryContract $accountTypeRepository, GatewayRepositoryContract $gatewayRepository,
                                ImageServiceContract $imageService, AccountCategoryTypeContract $accountCategoryTypeContract)
    {
        $this->accountTypeRepository = $accountTypeRepository;
        $this->gatewayRepository = $gatewayRepository;
        $this->imageService = $imageService;
        $this->accountCategoryTypeRepository = $accountCategoryTypeContract;
        $this->middleware('account.type.can-list', ['only' => ['index']]);
        $this->middleware('account.type.can-show', ['only' => ['show']]);
        $this->middleware('account.type.can-create', ['only' => ['create','store']]);
        $this->middleware('account.type.can-edit', ['only' => ['edit','update']]);
        $this->middleware('account.type.can-delete', ['only' => ['destroy']]);
    }

    public function Index(IndexAccountRequest $request)
    {
        $data = $request->validated();
        //$filterAccountTypes = $this->accountTypeRepository->getAll('')->pluck('name','id')->toArray();
        $accountTypes = $this->accountTypeRepository->paginate($data);
        $accountTypes->appends($request->validated());
        return view('backend.account.accountType.index', compact('accountTypes','data'));
    }

    public function create()
    {
        $gateways = $this->gatewayRepository->listsAll();
        $imgsUncolored = $this->accountTypeRepository->imgUncoloredListsAll()->prepend("", "");
        $accountCategoryTypes = $this->accountCategoryTypeRepository->all()->pluck('name', 'id')->prepend('', '');
        return view('backend.account.accountType.create', compact('gateways', 'imgsUncolored', 'accountCategoryTypes'));
    }

    public function edit($id)
    {

        $accountTypes = $this->accountTypeRepository->findById($id);

        $selectedGatewayId = $accountTypes->gateway_id;
        $gateways = $this->gatewayRepository->listsAll();
        $imgsUncolored = $this->accountTypeRepository->imgUncoloredListsAll()->prepend("", "");
        Breadcrumbs::setCurrentRoute('admin.accounts.types.edit', $accountTypes);
        $accountCategoryTypes = $this->accountCategoryTypeRepository->all()->pluck('name', 'id')->prepend('', '');
        return view('backend.account.accountType.edit', compact('selectedGatewayId', 'accountTypes', 'gateways','imgsUncolored', 'accountCategoryTypes'));
    }

    public function show($id)
    {
        $accountTypes = $this->accountTypeRepository->findById($id);
        Breadcrumbs::setCurrentRoute('admin.accounts.types.show', $accountTypes);
        return view('backend.account.accountType.show', compact('accountTypes'));
    }

    public function destroy($id)
    {
        try {
            $accountType = $this->accountTypeRepository->destroy($id);
            event(new UserModifiedEvent($accountType, Events::DELETED));
            session()->flash('flash_message', trans('alerts.general.success_delete'));
            return redirect()->route('admin.accounts.types.index');
        } catch (\Exception $e) {
            session()->flash('flash_message_error', trans('errorMessages.errors.try_errors.' . $e->getCode()));
            return redirect()->route('admin.accounts.types.index');
        }
    }

    public function store(StoreAccountTypeRequest $request)
    {
        $data = $request->validated();
        DB::beginTransaction();
        try {
            $folder = '/imgs/services/';
            $data['img_colored'] = $data['img_uncolored'];
            if ($request->has('icon_file') && !empty($request->icon_file)) {
                $image_format = 'png';
                $name = Uuid::uuid4();

                $image = $request->file('icon_file');
                $this->imageService->saveWithParamAndWithPlatform($image, 30, 30, $folder, $name.".".$image_format, 'android', $image_format);
                $this->imageService->saveWithParamAndWithPlatform($image, 30, 30, $folder, $name.".".$image_format, 'ios', $image_format);
                $this->imageService->saveWithParamAndWithPlatform($image, 30, 30, $folder, $name.".".$image_format, 'web', $image_format);

                $data['img_uncolored'] = $name.".".$image_format;
                $data['img_colored'] = $name.".".$image_format;
            }

            $accountType = $this->accountTypeRepository->create($data);
            $accountType->setChanges($accountType->getAttributes());
            event(new UserModifiedEvent($accountType, Events::CREATED));
            session()->flash('flash_message', trans('alerts.general.success_add'));
            DB::commit();
            return redirect()->route('admin.accounts.types.index');
        }catch (\Exception $e){
            DB::rollBack();
            session()->flash('flash_message_error', trans($e->getMessage()));
            Log::error($e->getMessage());
            Log::error($e->getTraceAsString());
            return redirect()->route('admin.accounts.types.create');
        }
    }

    public function update(UpdateAccountTypeRequest $request, $id)
    {
        $data = $request->validated();
        DB::beginTransaction();
        try {
            $folder = '/imgs/services/';
            $data['img_colored'] = $data['img_uncolored'];
            if ($request->has('icon_file') && !empty($request->icon_file)) {
                $image_format = 'png';
                $name = Uuid::uuid4();

                $image = $request->file('icon_file');
                $this->imageService->saveWithParamAndWithPlatform($image, 30, 30, $folder, $name.".".$image_format, 'android', $image_format);
                $this->imageService->saveWithParamAndWithPlatform($image, 30, 30, $folder, $name.".".$image_format, 'ios', $image_format);
                $this->imageService->saveWithParamAndWithPlatform($image, 30, 30, $folder, $name.".".$image_format, 'web', $image_format);

                $data['img_uncolored'] = $name.".".$image_format;
                $data['img_colored'] = $name.".".$image_format;
            }

            $accountType = $this->accountTypeRepository->update($data, $id);
            event(new UserModifiedEvent($accountType, Events::UPDATED));
            session()->flash('flash_message', trans('alerts.general.success_edit'));
            DB::commit();
            return redirect()->route('admin.accounts.types.index');
        }catch (\Exception $e)
        {
            DB::rollBack();
            Log::error($e->getMessage());
            Log::error($e->getTraceAsString());
            session()->flash('flash_message_error', trans($e->getMessage()));
            return redirect()->route('admin.accounts.types.edit',["id" => $id]);
        }
    }
}