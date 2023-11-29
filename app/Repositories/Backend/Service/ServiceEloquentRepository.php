<?php

namespace App\Repositories\Backend\Service;

use App\Models\Service\Filters\ServiceFilter;
use App\Repositories\Backend\Service\ServiceRepositoryContract;
use App\Models\Service\Service;
use App\Repositories\Backend\Setting\SettingRepositoryContract;
use App\Services\Common\Helpers\Setting;

class ServiceEloquentRepository implements ServiceRepositoryContract
{

    protected $service;
    protected $settingRepository;

    public function __construct(Service $service, SettingRepositoryContract $settingRepository)
    {
        $this->service = $service;
        $this->settingRepository = $settingRepository;
    }

    public function all($data=[],$columns = ['*'])
    {
        return $this->service->select($columns)->orderBy('created_at', 'desc')->filterBy(new ServiceFilter($data))->with(['gateway', 'workday', 'commission', 'service_limit','categories', 'service_otp_limit' ])->get($columns)->sortBy('position');
    }

    public function allPluck($columns = ['*'])
    {
        return $this->service->orderBy('created_at', 'desc')->get($columns)->sortBy('position')->pluck('name', 'id')->toArray();
    }

    public function allActive($columns = ['*'])
    {
        return $this->service->with(['gateway', 'workday', 'commission', 'service_limit'])->where('is_active', true)->orderBy('created_at', 'desc')->get($columns);
    }

    public function getByCode($code, $columns = ['*'])
    {
        return $this->service->with(['gateway', 'workday', 'commission', 'service_limit'])->where('code', $code)->first($columns);
    }

    public function getProcessingCodeByCode($processingCode, $columns = ['*'])
    {
        return $this->service->where('processing_code', $processingCode)->first($columns);
    }

    public function getIdByCode($code)
    {
        return $this->service->where('code', $code)->first(['id'])->id;
    }

    public function findById($id, $columns = ['*'])
    {
        return $this->service->with(['gateway', 'workday', 'commission', 'service_limit', 'service_otp_limit'])->select($columns)->find($id);
    }
    public function getById($id, $columns = ['*'])
    {
        return $this->service->select($columns)->find($id);
    }

    public function create(array $data)
    {
        $data['params_json'] = json_decode($data['params_json']);
        $data['extend_params_json'] = json_decode($data['extend_params_json']);
        $service = $this->service->create($data);

        $setting_menu_version = (integer)$this->settingRepository->findByKey(Setting::MENU_VERSION);
        $setting_data['key'] = Setting::MENU_VERSION;
        $setting_data['value'] = ++$setting_menu_version;
        $this->settingRepository->update($setting_data);

        return $service;
    }

    public function update(array $data, $id)
    {
        $service = $this->service->find($id);
        //dd($data['params_json']);
        $data['params_json'] = json_decode($data['params_json']);
        $data['extend_params_json'] = json_decode($data['extend_params_json']);
        $service->setOldAttributes($service->getAttributes());
        $service->update($data);
        //dd($data);

        $setting_menu_version = (integer)$this->settingRepository->findByKey(Setting::MENU_VERSION);
        $setting_data['key'] = Setting::MENU_VERSION;
        $setting_data['value'] = ++$setting_menu_version;
        $this->settingRepository->update($setting_data);
        return $service;
    }

    
    public function destroy($id)
    {
        $service = $this->service->find($id);
        $service->setOldAttributes($service->getAttributes());
        $service->delete();

        $setting_menu_version = (integer)$this->settingRepository->findByKey(Setting::MENU_VERSION);
        $setting_data['key'] = Setting::MENU_VERSION;
        $setting_data['value'] = ++$setting_menu_version;
        $this->settingRepository->update($setting_data);

        return $service;
    }

    public function paginate($perPage = 30, $columns = ['*'])
    {
        return $this->service->select($columns)->orderBy('created_at', 'desc')->paginate($perPage);
    }

    public function deleteImageIconUrl($id)
    {
        $service = $this->findById($id);
        $service->icon_url = null;
        $service->save();
        return $service;
    }

    public function deleteImageInIconUrl($id)
    {
        $service = $this->findById($id);
        $service->in_icon_url = null;
        $service->save();
        return $service;
    }

    public function deleteImageOutIconUrl($id)
    {
        $service = $this->findById($id);
        $service->out_icon_url = null;
        $service->save();
        return $service;
    }

    public function onOff($is_active, $id){
        $service = $this->findById($id);
        $service->is_active = $is_active;
        $service->save();
    }
}