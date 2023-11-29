<?php

namespace App\Http\Controllers\Backend\Web\Service;

use Exception;
use Carbon\Carbon;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Services\Common\Helpers\Events;
use App\Services\Common\Image\ImageServiceContract;
use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;
use App\Events\Backend\User\UserHistory\UserModifiedEvent;
use App\Http\Requests\Backend\Web\Service\IndexServiceRequest;
use App\Http\Requests\Backend\Web\Service\StoreServiceRequest;
use App\Http\Requests\Backend\Web\Service\UpdateServiceRequest;
use App\Repositories\Backend\Gateway\GatewayRepositoryContract;
use App\Repositories\Backend\Service\ServiceRepositoryContract;
use App\Repositories\Backend\Currency\CurrencyRepositoryContract;
use App\Repositories\Backend\Service\Commission\CommissionRepositoryContract;
use App\Repositories\Backend\Service\WorkDays\ServiceWorkdaysRepositoryContract;
use App\Repositories\Backend\Service\ServiceLimit\ServiceLimitRepositoryContract;
use App\Repositories\Backend\Service\ServiceOtpLimit\ServiceOtpLimitRepositoryContract;
use App\Repositories\Backend\Currency\CurrencyRateCategory\CurrencyRateCategoryRepositoryContract;

class ServiceController extends Controller
{
    protected $serviceRepository;
    protected $gatewayRepository;
    protected $serviceLimitRepository;
    protected $workdayRepository;
    protected $commissionRepository;
    protected $currencyRepository;
    protected $currencyRateCategoryRepository;
    protected $imageService;
    /**
     * @var ServiceOtpLimitRepositoryContract
     */
    private $serviceOtpLimitRepositoryContract;

    public function __construct(
        ServiceRepositoryContract $serviceRepository,
        GatewayRepositoryContract $gatewayRepository,
        ServiceLimitRepositoryContract $serviceLimitRepository,
        ServiceOtpLimitRepositoryContract $serviceOtpLimitRepositoryContract,
        ServiceWorkdaysRepositoryContract $workdayRepository,
        CommissionRepositoryContract $commissionRepository,
        CurrencyRepositoryContract $currencyRepository,
        CurrencyRateCategoryRepositoryContract $currencyRateCategoryRepository,
        ImageServiceContract $imageService
    ) {
        $this->serviceRepository = $serviceRepository;
        $this->gatewayRepository = $gatewayRepository;
        $this->serviceLimitRepository = $serviceLimitRepository;
        $this->workdayRepository = $workdayRepository;
        $this->commissionRepository = $commissionRepository;
        $this->currencyRepository = $currencyRepository;
        $this->currencyRateCategoryRepository = $currencyRateCategoryRepository;
        $this->middleware('service.can-list', ['only' => ['index']]);
        $this->middleware('service.can-show', ['only' => ['show']]);
        $this->middleware('service.can-create', ['only' => ['create', 'store']]);
        $this->middleware('service.can-edit', ['only' => ['edit', 'store']]);
        $this->middleware('service.can-delete', ['only' => ['destroy', 'store']]);
        $this->serviceOtpLimitRepositoryContract = $serviceOtpLimitRepositoryContract;
        $this->imageService = $imageService;
    }

    public function index(IndexServiceRequest $request)
    {
        $gateways = $this->gatewayRepository->listsAll()->prepend('', '');
        $workdays = $this->workdayRepository->listsAll()->prepend('', '');
        $currencies = $this->currencyRepository->listsAll()->prepend('', '');
        $commissions = $this->commissionRepository->listsAll()->prepend('', '');
        $currency_rate_categories = $this->currencyRateCategoryRepository->listsAll()->prepend('', '');
        $data = $request->validated();
        $service = $this->serviceRepository->all($data);
        return view('backend.service.index', compact('service', 'data', 'currencies', 'workdays', 'gateways', 'commissions', 'currency_rate_categories'));
    }

    public function create()
    {
        $gateways = $this->gatewayRepository->listsAll()->prepend('', '');
        $serviceLimits = $this->serviceLimitRepository->listsAll()->prepend('', '');
        $serviceOtpLimits = $this->serviceOtpLimitRepositoryContract->listsAll()->prepend('', '');
        $workdays = $this->workdayRepository->listsAll()->prepend('', '');
        $commissions = $this->commissionRepository->listsAll()->prepend('', '');
        $currencies = $this->currencyRepository->listsAll()->prepend('', '');
        $currency_rate_categories = $this->currencyRateCategoryRepository->listsAll()->prepend('', '');
        $service = null;

        return view('backend.service.create', compact(
            'service',
            'gateways',
            'serviceLimits',
            'serviceOtpLimits',
            'workdays',
            'commissions',
            'currencies',
            'currency_rate_categories'
        ));
    }

    public function edit($id)
    {
        $service = $this->serviceRepository->findById($id);
        $gateways = $this->gatewayRepository->listsAll()->prepend('', '');
        $serviceLimits = $this->serviceLimitRepository->listsAll()->prepend('', '');
        $serviceOtpLimits = $this->serviceOtpLimitRepositoryContract->listsAll()->prepend('', '');
        $workdays = $this->workdayRepository->listsAll()->prepend('', '');
        $commissions = $this->commissionRepository->listsAll()->prepend('', '');
        $currencies = $this->currencyRepository->listsAll()->prepend('', '');
        $currency_rate_categories = $this->currencyRateCategoryRepository->listsAll()->prepend('', '');
        Breadcrumbs::setCurrentRoute('admin.services.edit', $service);
        //dd($service);
        return view('backend.service.edit', compact(
            'service',
            'gateways',
            'serviceLimits',
            'serviceOtpLimits',
            'workdays',
            'commissions',
            'currencies',
            'currency_rate_categories'
        ));
    }

    public function show($id)
    {
        $service = $this->serviceRepository->findById($id);
        Breadcrumbs::setCurrentRoute('admin.services.show', $service);
        return view('backend.service.show', compact('service'));
    }

    public function destroy($id)
    {
        $service = $this->serviceRepository->destroy($id);
        event(new UserModifiedEvent($service, Events::DELETED));
        session()->flash('flash_message', trans('alerts.general.success_delete'));
        return redirect()->route('admin.services.index');
    }

    public function store(StoreServiceRequest $request)
    {
        $data = $request->validated();
        DB::beginTransaction();
        try {
            $folder = '/imgs/services/';

            if ($request->has('icon_url') && $data['icon_url'] != null) {
                $image_format = 'png';
                $timestamp = Carbon::now()->format('Y-m-d_H-i-s-u');
                $name = Uuid::uuid4() . '_' . $timestamp . '.' . $image_format;

                $image = $request->file('icon_url');
                $this->imageService->saveWithParamAndWithPlatform($image, 27, 27, $folder, $name, 'android', $image_format);
                $this->imageService->saveWithParamAndWithPlatform($image, 36, 36, $folder, $name, 'ios', $image_format);

                $data['icon_url'] = $name;
            }

            if ($request->has('in_icon_url') && $data['in_icon_url'] != null) {
                $image_format = 'png';
                $timestamp = Carbon::now()->format('Y-m-d_H-i-s-u');
                $name = Uuid::uuid4() . '_' . $timestamp . '.' . $image_format;

                $image = $request->file('in_icon_url');
                $this->imageService->saveWithParamAndWithPlatform($image, 27, 27, $folder, $name, 'android', $image_format);
                $this->imageService->saveWithParamAndWithPlatform($image, 36, 36, $folder, $name, 'ios', $image_format);

                $data['in_icon_url'] = $name;
            }

            if ($request->has('out_icon_url') && $data['out_icon_url'] != null) {
                $image_format = 'png';
                $timestamp = Carbon::now()->format('Y-m-d_H-i-s-u');
                $name = Uuid::uuid4() . '_' . $timestamp . '.' . $image_format;

                $image = $request->file('out_icon_url');
                $this->imageService->saveWithParamAndWithPlatform($image, 27, 27, $folder, $name, 'android', $image_format);
                $this->imageService->saveWithParamAndWithPlatform($image, 36, 36, $folder, $name, 'ios', $image_format);

                $data['out_icon_url'] = $name;
            }

            $service = $this->serviceRepository->create($data);
            $service->setChanges($service->getAttributes());
            event(new UserModifiedEvent($service, Events::CREATED));
            session()->flash('flash_message', trans('alerts.general.success_add'));
            DB::commit();
            return redirect()->route('admin.services.index');
        } catch (Exception $e) {
            DB::rollBack();
            session()->flash('flash_message_error', trans('errorMessages.errors.try_errors.' . $e->getMessage() . $e->getCode()));
            return redirect()->route('admin.services.index');
        }
    }

    public function update(UpdateServiceRequest $request, $id)
    {

        $data = $request->validated();
        DB::beginTransaction();
        try {

            $folder = '/imgs/services/';

            if ($request->has('icon_url') && $data['icon_url'] != null) {
                $image_format = 'png';
                $name = $this->serviceRepository->findById($id)->img_logo;
                $this->deleteImage($name);

                $timestamp = Carbon::now()->format('Y-m-d_H-i-s-u');
                $name = Uuid::uuid4() . '_' . $timestamp . '.' . $image_format;

                $image = $request->file('icon_url');
                $this->imageService->saveWithParamAndWithPlatform($image, 27, 27, $folder, $name, 'android', $image_format);
                $this->imageService->saveWithParamAndWithPlatform($image, 36, 36, $folder, $name, 'ios', $image_format);

                $data['icon_url'] = $name;
            }

            if ($request->has('in_icon_url') && $data['in_icon_url'] != null) {
                $image_format = 'png';
                $name = $this->serviceRepository->findById($id)->img_logo;
                $this->deleteImage($name);
                
                $timestamp = Carbon::now()->format('Y-m-d_H-i-s-u');
                $name = Uuid::uuid4() . '_' . $timestamp . '.' . $image_format;

                $image = $request->file('in_icon_url');
                $this->imageService->saveWithParamAndWithPlatform($image, 27, 27, $folder, $name, 'android', $image_format);
                $this->imageService->saveWithParamAndWithPlatform($image, 36, 36, $folder, $name, 'ios', $image_format);

                $data['in_icon_url'] = $name;
            }

            if ($request->has('out_icon_url') && $data['out_icon_url'] != null) {
                $image_format = 'png';
                $name = $this->serviceRepository->findById($id)->img_logo;
                $this->deleteImage($name);
                
                $timestamp = Carbon::now()->format('Y-m-d_H-i-s-u');
                $name = Uuid::uuid4() . '_' . $timestamp . '.' . $image_format;

                $image = $request->file('out_icon_url');
                $this->imageService->saveWithParamAndWithPlatform($image, 27, 27, $folder, $name, 'android', $image_format);
                $this->imageService->saveWithParamAndWithPlatform($image, 36, 36, $folder, $name, 'ios', $image_format);

                $data['out_icon_url'] = $name;
            }

            $service = $this->serviceRepository->update($data, $id);
            event(new UserModifiedEvent($service, Events::UPDATED));
            session()->flash('flash_message', trans('alerts.general.success_edit'));
            DB::commit();
            return redirect()->route('admin.services.index');
        } catch (Exception $e) {
            DB::rollBack();
            session()->flash('flash_message_error', trans('errorMessages.errors.try_errors.' . $e->getMessage() . $e->getCode()));
            return redirect()->route('admin.merchants.index');
        }
    }

    private function deleteImage($name)
    {
        if ($name != null) {
            $folder = public_path(str_replace('/', DIRECTORY_SEPARATOR, 'imgs/services/'));
            $this->imageService->delete($folder . '1', $name . '.jpg');
            $this->imageService->delete($folder . '2', $name . '.jpg');
            $this->imageService->delete($folder . '3', $name . '.jpg');
            $this->imageService->delete($folder . 'hdpi', $name . '.jpg');
            $this->imageService->delete($folder . 'ldpi', $name . '.jpg');
            $this->imageService->delete($folder . 'mdpi', $name . '.jpg');
            $this->imageService->delete($folder . 'xhdpi', $name . '.jpg');
            $this->imageService->delete($folder . 'xxhdpi', $name . '.jpg');
            $this->imageService->delete($folder . 'xxxhdpi', $name . '.jpg');
        }
    }

    public function deleteImageIconUrl($id)
    {
        try {
            $name = $this->serviceRepository->findById($id)->icon_url;
            $this->deleteImage($name);

            $service = $this->serviceRepository->deleteImageIconUrl($id);
            event(new UserModifiedEvent($service, Events::UPDATED));
            session()->flash('flash_message', trans('alerts.general.success_delete'));
            return redirect()->route('admin.merchants.edit', $id);
        } catch (\Exception $e) {
            session()->flash('flash_message_error', trans('errorMessages.errors.try_errors.' . $e->getMessage()));
            return redirect()->route('admin.merchants.edit', $id);
        }
    }

    public function deleteImageInIconUrl($id)
    {
        try {
            $name = $this->serviceRepository->findById($id)->in_icon_url;
            $this->deleteImage($name);

            $service = $this->serviceRepository->deleteImageInIconUrl($id);
            event(new UserModifiedEvent($service, Events::UPDATED));
            session()->flash('flash_message', trans('alerts.general.success_delete'));
            return redirect()->route('admin.services.edit', $id);
        } catch (\Exception $e) {
            session()->flash('flash_message_error', trans('errorMessages.errors.try_errors.' . $e->getCode()));
            return redirect()->route('admin.services.edit', $id);
        }
    }

    public function deleteImageOutIconUrl($id)
    {
        try {
            $name = $this->serviceRepository->findById($id)->out_icon_url;
            $this->deleteImage($name);

            $service = $this->serviceRepository->deleteImageOutIconUrl($id);
            event(new UserModifiedEvent($service, Events::UPDATED));
            session()->flash('flash_message', trans('alerts.general.success_delete'));
            return redirect()->route('admin.services.edit', $id);
        } catch (\Exception $e) {
            session()->flash('flash_message_error', trans('errorMessages.errors.try_errors.' . $e->getCode()));
            return redirect()->route('admin.services.edit', $id);
        }
    }
}
