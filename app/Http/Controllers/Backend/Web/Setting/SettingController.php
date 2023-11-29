<?php
/**
 * Created by PhpStorm.
 * User: F_Kosimov
 * Date: 19.07.2018
 * Time: 14:50
 */

namespace App\Http\Controllers\Backend\Web\Setting;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Web\Setting\StoreSettingRequest;
use App\Http\Requests\Backend\Web\Setting\UpdateSettingRequest;
use App\Repositories\Backend\Setting\SettingRepositoryContract;
use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;

class SettingController extends Controller
{
    protected $SettingsRepository;

    public function __construct(SettingRepositoryContract $SettingsRepository)
    {
        $this->SettingsRepository = $SettingsRepository;
        $this->middleware('settings.can-manage');
    }

    public function index()
    {
        $settings = $this->SettingsRepository->all();
        //dd($settings);
        return view('backend.setting.index', compact('settings'));
    }
    public function show($key)
    {
        $value = $this->SettingsRepository->findByKey($key);
        $setting = new \stdClass();
        $setting->key = $key;
        $setting->value = $value;
        Breadcrumbs::setCurrentRoute('admin.settings.edit', $setting);
        return view('backend.setting.show',compact('setting'));
    }

    public function create()
    {
        return view('backend.setting.create');
    }

    public function store(StoreSettingRequest $request)
    {
        $this->SettingsRepository->create($request->validated());
        session()->flash('flash_message', trans('alerts.general.success_add'));
        return redirect()->route('admin.settings.index');
    }

    public function edit($key)
    {
        $value = $this->SettingsRepository->findByKey($key);
        $setting = new \stdClass();
        $setting->key = $key;
        $setting->value = $value;
        Breadcrumbs::setCurrentRoute('admin.settings.edit', $setting);
        return view('backend.setting.edit',compact('setting'));
    }

    public function update(UpdateSettingRequest $request, $id)
    {
        $this->SettingsRepository->update($request->validated(), $id);
        session()->flash('flash_message', trans('alerts.general.success_edit'));
        return redirect()->route('admin.settings.index');
    }
    public function destroy ($id)
    {
        $this->SettingsRepository->destroy($id);
        session()->flash('flash_message', trans('alerts.general.success_delete'));
        return redirect()->route('admin.settings.index');
    }
}