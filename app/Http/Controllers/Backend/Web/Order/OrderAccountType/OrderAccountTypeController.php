<?php

namespace App\Http\Controllers\Backend\Web\Order\OrderAccountType;

use DB;
use Breadcrumbs;
use Ramsey\Uuid\Uuid;
use App\Http\Controllers\Controller;
use App\Services\Common\Helpers\Events;
use App\Services\Common\Image\ImageServiceContract;
use App\Events\Backend\User\UserHistory\UserModifiedEvent;
use App\Http\Requests\Backend\Web\Order\OrderAccountType\StoreOrderAccountTypeRequest;
use App\Http\Requests\Backend\Web\Order\OrderAccountType\UpdateOrderAccountTypeRequest;
use App\Repositories\Backend\Service\ServiceRepositoryContract;
use App\Repositories\Backend\Currency\CurrencyRepositoryContract;
use App\Repositories\Backend\Order\OrderAccountType\OrderAccountTypeRepositoryContract;
use App\Repositories\Backend\OrderCardContractType\OrderCardContractTypeRepositoryContract;


class OrderAccountTypeController extends Controller
{
   
    private $orderAccountTypeRepository;

    private $currencyRepositoryContract;

    private $orderCardContractTypeRepositoryContract;
    protected $serviceRepository;

    private $imageService;

    public function __construct(OrderAccountTypeRepositoryContract $orderAccountTypeRepository,
                                CurrencyRepositoryContract $currencyRepositoryContract,
                                ServiceRepositoryContract $serviceRepository,
                                OrderCardContractTypeRepositoryContract $orderCardContractTypeRepositoryContract,
                                ImageServiceContract $imageService)
    {
        $this->orderAccountTypeRepository = $orderAccountTypeRepository;
        $this->currencyRepositoryContract = $currencyRepositoryContract;
        $this->serviceRepository = $serviceRepository;
        $this->orderCardContractTypeRepositoryContract = $orderCardContractTypeRepositoryContract;
        $this->imageService = $imageService;

        $this->middleware('orderAccountType.can-list', ['only' => ['index']]);
        $this->middleware('orderAccountType.can-show', ['only' => ['show']]);
        $this->middleware('orderAccountType.can-create', ['only' => ['create', 'store']]);
        $this->middleware('orderAccountType.can-edit', ['only' => ['edit', 'update']]);
        $this->middleware('orderAccountType.can-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $orderAccountTypes = $this->orderAccountTypeRepository->paginate();
        return view('backend.order.orderAccountType.index', compact('orderAccountTypes'));
    }

    public function create()
    {
        $icons = $this->orderAccountTypeRepository->iconListsAll()->prepend("", "");
        $services = $services = $this->serviceRepository->allPluck();
        return view('backend.order.orderAccountType.create',compact('icons','services'));
    }

    public function store(StoreOrderAccountTypeRequest $request)
    {
        $data = $request->validated();

        try {
            DB::beginTransaction();
            //Хард код
            $folder = '/imgs/orders/accounts/';

            if ($request->has('icon_file') && !empty($request->icon_file)) {
                $image_format = 'png';
                $name = Uuid::uuid4();
                $image = $request->file('icon_file');
                $this->imageService->saveWithParamAndWithPlatform($image, 126, 126, $folder, $name . "." . $image_format, 'android', $image_format);
                $this->imageService->saveWithParamAndWithPlatform($image, 126, 126, $folder, $name . "." . $image_format, 'ios', $image_format);
                $this->imageService->saveWithParamAndWithPlatform($image, 126, 126, $folder, $name . "." . $image_format, 'web', $image_format);

                $data['icon'] = $name;
            }

            if (empty($data['icon'])) {
                session()->flash('flash_message_error', "Иконка не задана");
                return redirect()->route('admin.order.orderAccountType.create');
            }

            $model = $this->orderAccountTypeRepository->create($data);
            $model->setChanges($model->getAttributes());
            event(new UserModifiedEvent($model, Events::CREATED));
            DB::commit();
            session()->flash('flash_message', trans('alerts.general.success_add'));
            return redirect()->route('admin.order.orderAccountType.index');
        }catch (\Exception $e) {
            DB::rollBack();
            session()->flash('flash_message_error', trans($e->getMessage()));
            return redirect()->route('admin.order.orderAccountType.create');
        }
    }

    public function edit($id)
    {
        $data = $this->orderAccountTypeRepository->getById($id);
        $icons = $this->orderAccountTypeRepository->iconListsAll()->prepend("", "");
        $services = $services = $this->serviceRepository->allPluck();
        Breadcrumbs::setCurrentRoute('admin.order.orderAccountType.edit', $data);
        return view('backend.order.orderAccountType.edit', compact('services','icons','data'));
    }

    public function update(UpdateOrderAccountTypeRequest $request, $id)
    {
        $data = $request->validated();
        try {
            DB::beginTransaction();

            $folder = '/imgs/orders/accounts/';

            if ($request->has('icon_file') && !empty($request->icon_file)) {
                $image_format = 'png';
                $name = Uuid::uuid4();

                $image = $request->file('icon_file');
                $this->imageService->saveWithParamAndWithPlatform($image, 126, 126, $folder, $name.".".$image_format, 'android', $image_format);
                $this->imageService->saveWithParamAndWithPlatform($image, 126, 126, $folder, $name.".".$image_format, 'ios', $image_format);
                $this->imageService->saveWithParamAndWithPlatform($image, 126, 126, $folder, $name.".".$image_format, 'web', $image_format);

                $data['icon'] = $name;
            }

            // Удалить иконку если иконка привязано только этой записи
            $orderCardTypeData = $this->orderAccountTypeRepository->getById($id);
            $orderCardTypeIcons = $this->orderAccountTypeRepository->getIconsByNameAndNotEqualId($orderCardTypeData["icon"], $id);
            if($orderCardTypeIcons->count() == 0 && $data['icon'] != $orderCardTypeData["icon"])
            {
                $this->deleteImage($orderCardTypeData["icon"]);
            }

            if(empty($data['icon']))
            {
                session()->flash('flash_message_error', "Иконка не задана");
                return redirect()->route('admin.order.orderAccountType.edit',["id" => $id]);
            }

            $model = $this->orderAccountTypeRepository->update($data, $id);
            event(new UserModifiedEvent($model, Events::UPDATED));
            DB::commit();
            session()->flash('flash_message', trans('alerts.general.success_edit'));
            return redirect()->route('admin.order.orderAccountType.index');
        }catch (\Exception $e) {
            DB::rollBack();
            session()->flash('flash_message_error', trans($e->getMessage()));
            return redirect()->route('admin.order.orderAccountType.edit',["id" => $id]);
        }
    }

    public function destroy($id)
    {
        try {
            $model = $this->orderAccountTypeRepository->destroy($id);
            event(new UserModifiedEvent($model, Events::DELETED));
            session()->flash('flash_message', trans('alerts.general.success_delete'));
            return redirect()->route('admin.order.orderAccountType.index');
        } catch (\Exception $e) {
            session()->flash('flash_message_error', trans('errorMessages.errors.try_errors.' . $e->getCode()));
            return redirect()->route('admin.order.orderAccountType.index');
        }
    }

    public function deleteImage($name)
    {
        if($name!=null)
        {
            $folder = public_path(str_replace('/',DIRECTORY_SEPARATOR,'imgs/orders/accounts/'));
            
                $this->imageService->delete($folder . '1', $name . '.png');
                $this->imageService->delete($folder . '2', $name . '.png');
                $this->imageService->delete($folder . '3', $name . '.png');
                $this->imageService->delete($folder . 'hdpi', $name . '.png');
                $this->imageService->delete($folder . 'ldpi', $name . '.png');
                $this->imageService->delete($folder . 'mdpi', $name . '.png');
                $this->imageService->delete($folder . 'xhdpi', $name . '.png');
                $this->imageService->delete($folder . 'xxhdpi', $name . '.png');
                $this->imageService->delete($folder . 'xxxhdpi', $name . '.png');
                $this->imageService->delete($folder . 'web', $name . '.png');
        }
    }
}
