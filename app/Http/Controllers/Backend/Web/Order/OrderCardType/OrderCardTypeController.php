<?php

namespace App\Http\Controllers\Backend\Web\Order\OrderCardType;

use App\Http\Requests\Backend\Web\Order\OrderCardType\IndexOrderCardTypeRequest;
use App\Services\Common\Image\ImageServiceContract;
use Breadcrumbs;
use App\Http\Controllers\Controller;
use App\Services\Common\Helpers\Events;
use App\Events\Backend\User\UserHistory\UserModifiedEvent;
use App\Repositories\Backend\OrderCardType\OrderCardTypeRepositoryContract;
use App\Repositories\Backend\Currency\CurrencyRepositoryContract;
use App\Http\Requests\Backend\Web\Order\OrderCardType\StoreOrderCardTypeRequest;
use App\Http\Requests\Backend\Web\Order\OrderCardType\UpdateOrderCardTypeRequest;
use App\Repositories\Backend\OrderCardContractType\OrderCardContractTypeRepositoryContract;
use DB;
use Illuminate\Support\Facades\Log;
use Ramsey\Uuid\Uuid;


class OrderCardTypeController extends Controller
{
   
    private $orderCardTypeRepository;

    private $currencyRepositoryContract;

    private $orderCardContractTypeRepositoryContract;

    private $imageService;

    public function __construct(OrderCardTypeRepositoryContract $orderCardTypeRepository,
                                CurrencyRepositoryContract $currencyRepositoryContract,
                                OrderCardContractTypeRepositoryContract $orderCardContractTypeRepositoryContract,
                                ImageServiceContract $imageService)
    {
        $this->orderCardTypeRepository = $orderCardTypeRepository;
        $this->currencyRepositoryContract = $currencyRepositoryContract;
        $this->orderCardContractTypeRepositoryContract = $orderCardContractTypeRepositoryContract;
        $this->imageService = $imageService;

        $this->middleware('orderCardType.can-list', ['only' => ['index']]);
        $this->middleware('orderCardType.can-show', ['only' => ['show']]);
        $this->middleware('orderCardType.can-create', ['only' => ['create', 'store']]);
        $this->middleware('orderCardType.can-edit', ['only' => ['edit', 'update']]);
        $this->middleware('orderCardType.can-delete', ['only' => ['destroy']]);
    }

    public function index(IndexOrderCardTypeRequest $request)
    {
        $filterFields = $request->validated();
        $currencies = $this->currencyRepositoryContract->all()->pluck('iso_name', 'id')->toArray();
        $orderCardTypes = $this->orderCardTypeRepository->paginate($filterFields);

        return view('backend.order.orderCardType.index', compact('orderCardTypes', 'filterFields', 'currencies'));
    }

    public function create()
    {
        $currencies = $this->currencyRepositoryContract->listsAll()->prepend("","");
        $dbIcons = $this->orderCardTypeRepository->iconListsAll()->prepend("", "");
        $storageIcons = $this->imageService->getIconsFromStorage(public_path('imgs/accounts/web'));
        $usedIcons = $this->imageService->markUsedIcons($dbIcons->toArray(), $storageIcons);
        $storageIcons = [''=>''] + $storageIcons;
        $orderCardContractTypes = $this->orderCardContractTypeRepositoryContract->listsAllActive()->prepend("","");

        return view('backend.order.orderCardType.create',compact('currencies','storageIcons','orderCardContractTypes', 'usedIcons'));
    }

    public function store(StoreOrderCardTypeRequest $request)
    {
        $data = $request->validated();

        try {
            DB::beginTransaction();


            $folder = '/imgs/accounts/';

            if ($request->has('icon_file') && !empty($request->icon_file)) {
                $image_format = 'png';
                $name = str_replace([' ', '.png', '.jpg', '.jpeg'], '',mb_strtolower($request->file('icon_file')->getClientOriginalName())). Uuid::uuid4();
                $image = $request->file('icon_file');
                $this->imageService->saveWithParamAndWithPlatform($image, 126, 126, $folder, "all_" . $name . "." . $image_format, 'android', $image_format);
                $this->imageService->saveWithParamAndWithPlatform($image, 126, 126, $folder, "all_" . $name . "." . $image_format, 'ios', $image_format);
                $this->imageService->saveWithParamAndWithPlatform($image, 126, 126, $folder, "all_" . $name . "." . $image_format, 'web', $image_format);

                $this->imageService->saveWithParamAndWithPlatform($image, 174, 174, $folder, "main_" . $name . "." . $image_format, 'android', $image_format);
                $this->imageService->saveWithParamAndWithPlatform($image, 174, 174, $folder, "main_" . $name . "." . $image_format, 'ios', $image_format);
                $this->imageService->saveWithParamAndWithPlatform($image, 174, 174, $folder, "main_" . $name . "." . $image_format, 'web', $image_format);

                $data['icon'] = $name;
            }

            if (empty($data['icon'])) {
                session()->flash('flash_message_error', "Не задано иконка");
                return redirect()->route('admin.order.orderCardType.create');
            }
            $paramsJson = json_decode($data['params_json'], true);
            $paramsJson['spa_info_blocks']['about_card']['img'] = 'all_' . $data['icon'].'.png';
            $data['params_json'] = json_encode($paramsJson);
            //Хард код
            $data["html_params_json"] = json_decode($data["params_json"]);
            unset($data["params_json"]);

            $model = $this->orderCardTypeRepository->create($data);
            $model->setChanges($model->getAttributes());
            // call rshync
            exec("rsync -avz -e ssh --include 'all_abc*' /web/sites/online.eskhata.tj/www/public/imgs/accounts/* root@10.10.2.207:/var/app/webapiwallet/wwwroot/imgs/accounts/");
            event(new UserModifiedEvent($model, Events::CREATED));
            DB::commit();
            session()->flash('flash_message', trans('alerts.general.success_add'));
            return redirect()->route('admin.order.orderCardType.index');
        }catch (\Exception $e) {
            DB::rollBack();
            session()->flash('flash_message_error', trans($e->getMessage()));
            return redirect()->route('admin.order.orderCardType.create');
        }
    }

    public function edit($id)
    {
        $data = $this->orderCardTypeRepository->getById($id);
        $currencies = $this->currencyRepositoryContract->listsAll()->prepend("","");
        $orderCardContractTypes = $this->orderCardContractTypeRepositoryContract->listsAll()->prepend("","");
        $dbIcons = $this->orderCardTypeRepository->iconListsAll()->prepend("", "");
        $storageIcons = $this->imageService->getIconsFromStorage(public_path('imgs/accounts/web'));
        $usedIcons = $this->imageService->markUsedIcons($dbIcons->toArray(), $storageIcons);
        $storageIcons = [''=>''] + $storageIcons;
        Breadcrumbs::setCurrentRoute('admin.order.orderCardType.edit', $data);

        return view('backend.order.orderCardType.edit', compact('currencies','orderCardContractTypes','storageIcons', 'usedIcons', 'data'));
    }

    public function update(UpdateOrderCardTypeRequest $request, $id)
    {
        $data = $request->validated();

        try {
            DB::beginTransaction();
            $folder = '/imgs/accounts/';

            if($data['icon']){
                $data['icon'] = trim($data['icon'], '.png');
            }

            if ($request->has('icon_file') && !empty($request->icon_file)) {
                $image_format = 'png';
                $name = str_replace([' ', '.png', '.jpg', '.jpeg'], '',mb_strtolower($request->file('icon_file')->getClientOriginalName())). Uuid::uuid4();

                $image = $request->file('icon_file');
                $this->imageService->saveWithParamAndWithPlatform($image, 126, 126, $folder, "all_".$name.".".$image_format, 'android', $image_format);
                $this->imageService->saveWithParamAndWithPlatform($image, 126, 126, $folder, "all_".$name.".".$image_format, 'ios', $image_format);
                $this->imageService->saveWithParamAndWithPlatform($image, 126, 126, $folder, "all_".$name.".".$image_format, 'web', $image_format);

                $this->imageService->saveWithParamAndWithPlatform($image, 174, 174, $folder, "main_".$name.".".$image_format, 'android', $image_format);
                $this->imageService->saveWithParamAndWithPlatform($image, 174, 174, $folder, "main_".$name.".".$image_format, 'ios', $image_format);
                $this->imageService->saveWithParamAndWithPlatform($image, 174, 174, $folder, "main_".$name.".".$image_format, 'web', $image_format);

                $data['icon'] = $name;
            }


            if(empty($data['icon']))
            {
                session()->flash('flash_message_error', "Не задано иконка");
                return redirect()->route('admin.order.orderCardType.edit',["id" => $id]);
            }
            $paramsJson = json_decode($data['params_json'], true);
            $paramsJson['spa_info_blocks']['about_card']['img'] = 'all_' . $data['icon'].'.png';
            $data['params_json'] = json_encode($paramsJson);
            //Хард код
            $data["html_params_json"] = json_decode($data["params_json"]);
            unset($data["params_json"]);

            $model = $this->orderCardTypeRepository->update($data, $id);
            exec("rsync -avz -e ssh --include 'all_abc*' /web/sites/online.eskhata.tj/www/public/imgs/accounts/* root@10.10.2.207:/var/app/webapiwallet/wwwroot/imgs/accounts/");
            event(new UserModifiedEvent($model, Events::UPDATED));
            DB::commit();
            session()->flash('flash_message', trans('alerts.general.success_edit'));
            return redirect()->route('admin.order.orderCardType.index');
        }catch (\Exception $e) {
            DB::rollBack();
            session()->flash('flash_message_error', trans($e->getMessage()));
            Log::error($e->getMessage());
            Log::error($e->getTraceAsString());
            return redirect()->route('admin.order.orderCardType.edit',["id" => $id]);
        }
    }

    public function destroy($id)
    {
        try {
            $model = $this->orderCardTypeRepository->destroy($id);
            event(new UserModifiedEvent($model, Events::DELETED));
            session()->flash('flash_message', trans('alerts.general.success_delete'));
            return redirect()->route('admin.order.orderCardType.index');
        } catch (\Exception $e) {
            session()->flash('flash_message_error', trans('errorMessages.errors.try_errors.' . $e->getCode()));
            return redirect()->route('admin.order.orderCardType.index');
        }
    }

    public function deleteImage($icon)
    {
        if($icon!=null)
        {
            $folder = public_path(str_replace('/',DIRECTORY_SEPARATOR,'imgs/accounts/'));
            foreach (["all_","main_"] as $prefix) {
                $this->imageService->delete($folder . '1', $prefix.$icon );
                $this->imageService->delete($folder . '2', $prefix.$icon);
                $this->imageService->delete($folder . '3', $prefix.$icon);
                $this->imageService->delete($folder . 'hdpi', $prefix.$icon);
                $this->imageService->delete($folder . 'ldpi', $prefix.$icon);
                $this->imageService->delete($folder . 'mdpi', $prefix.$icon);
                $this->imageService->delete($folder . 'xhdpi', $prefix.$icon);
                $this->imageService->delete($folder . 'xxhdpi', $prefix.$icon);
                $this->imageService->delete($folder . 'xxxhdpi', $prefix.$icon);
                $this->imageService->delete($folder . 'web', $prefix.$icon);
            }

            return ['success'=>true];
        }

        return ['success'=>false, 'message' =>'Icon name must not be null'];
    }


}
