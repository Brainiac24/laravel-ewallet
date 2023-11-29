<?php

namespace App\Http\Controllers\Backend\Web\Service\Menu;

use App\Events\Backend\User\UserHistory\UserModifiedEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Web\Service\Menu\StoreMenuRequest;
use App\Http\Requests\Backend\Web\Service\Menu\UpdateMenuRequest;
use App\Repositories\Backend\Service\Category\CategoryRepositoryContract;
use App\Repositories\Backend\Service\ServiceRepositoryContract;
use App\Repositories\Backend\Setting\SettingRepositoryContract;
use App\Services\Common\Helpers\Events;
use App\Services\Common\Helpers\Setting;
use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;

class MenuController extends Controller
{
    protected $serviceRepository;
    protected $categoryRepository;
    protected $settingRepository;

    public function __construct(ServiceRepositoryContract $serviceRepository, CategoryRepositoryContract $categoryRepository, SettingRepositoryContract $settingRepository)
    {
        $this->serviceRepository = $serviceRepository;
        $this->categoryRepository = $categoryRepository;
        $this->settingRepository = $settingRepository;

        $this->middleware('service.menu.can-list', ['only' => ['index']]);
        $this->middleware('service.menu.can-show', ['only' => ['show']]);
        $this->middleware('service.menu.can-create', ['only' => ['create','store']]);
        $this->middleware('service.menu.can-edit', ['only' => ['edit','update']]);
        $this->middleware('service.menu.can-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $services = $this->serviceRepository->all();
        $categories = $this->categoryRepository->all();

        $menu = [];
        $item = null;
        foreach ($categories as $category) {
            //dd($category->services);
            foreach ($category->services as $service) {
                //dd($category->parent_id);
                $arr = [$category->id => $category->name];
                $this->buildTree($categories, $category->parent_id, $arr);
                $arr = implode(' -> ', $arr);
                $item = [
                    'id' => $service->id,
                    'service_code' => $service->code,
                    'service_processing_code' => $service->processing_code,
                    'category_id' => $category->id,
                    'category_name' => $arr,
                    'service_name' => $service->name,
                    'position' => $service->pivot->position,
                    'service_icon_url' => $service->icon_url,
                    'icon_url' => $service->icon_url,
                    'service_is_active' => $service->is_active,
                    'updated_at' => $service->updated_at,
                    'created_at' => $service->created_at,
                    'service_updated_at' => (string) $service->updated_at,
                ];
                $menu[] = $item;
            }
        }
//dd($menu);
        \array_multisort(array_column($menu, 'service_name'), SORT_ASC, $menu);
        //dd($menu);

        return view('backend.service.menu.index', compact('menu'));
    }

    public function buildTree($categories, $parent_id, &$arr)
    {
        foreach ($categories as $cat) {
            if ($cat->id == $parent_id) {
                //array_unshift($arr, $cat->name);
                $arr = [$cat->id => $cat->name] + $arr;
                $this->buildTree($categories, $cat->parent_id, $arr);
            }
        }
    }

    public function buildTreeChild($categories, $cat_id, $cat_name)
    {
        $arr = [];
        foreach ($categories as $cat2) {
            if ($cat_id == $cat2->parent_id) {

                $arr += [$cat2->id => $cat_name . ' -> ' . $cat2->name];
                $arr += $this->buildTreeChild($categories, $cat2->id, $cat_name . ' -> ' . $cat2->name);
            }
        }

        return $arr;
    }

    public function create()
    {
        $services = $this->serviceRepository->all();
        $categories = $this->categoryRepository->all();

        $menu = [];
        foreach ($categories as $cat) {
            $menu += [$cat->id => $cat->name];
            $menu += $this->buildTreeChild($categories, $cat->id, $cat->name);

        }
        //dd($menu);
        return view('backend.service.menu.create', compact([
            'services',
            'menu',
        ]));
    }

    public function edit($id, $cat_id, $position)
    {
        $services = $this->serviceRepository->findById($id);
        $categories = $this->categoryRepository->all();
        $menu_id = $id;
        $menu = [];
        foreach ($categories as $cat) {
            $menu += [$cat->id => $cat->name];
            $menu += $this->buildTreeChild($categories, $cat->id, $cat->name);
        }

        Breadcrumbs::setCurrentRoute('admin.menu.edit', $services);
        return view('backend.service.menu.edit', compact(['services', 'menu', 'menu_id', 'cat_id', 'position']));
    }

    public function show($id)
    {
        $service = $this->serviceRepository->findById($id);
        $categories = $this->categoryRepository->all();

        $menu = [];
        $item = null;
        foreach ($service->categories as $category) {
            $arr = [$category->id => $category->name];
            $this->buildTree($categories, $category->parent_id, $arr);
            $arr = implode(' -> ', $arr);
            $item = [
                'id' => $service->id,
                'service_code' => $service->code,
                'service_processing_code' => $service->processing_code,
                'category_id' => $category->id,
                'category_name' => $arr,
                'service_name' => $service->name,
                'position' => $category->pivot->position,
                'service_icon_url' => $service->icon_url,
                'service_is_active' => $service->is_active,
                'service_updated_at' => (string) $service->updated_at,
            ];
        }
        $menu[] = $item;

        Breadcrumbs::setCurrentRoute('admin.menu.show', $service);
        return view('backend.service.menu.show', compact('menu'));
    }

    public function destroy($id, $cat_id)
    {
        $service = $this->serviceRepository->findById($id);
        $service->categories()->detach( $cat_id);
        //event(new UserModifiedEvent($service, Events::DELETED));
        $setting_menu_version = (integer)$this->settingRepository->findByKey(Setting::MENU_VERSION);
        $setting_data['key'] = Setting::MENU_VERSION;
        $setting_data['value'] = ++$setting_menu_version;
        $this->settingRepository->update($setting_data);

        session()->flash('flash_message', trans('alerts.general.success_delete'));
        return redirect()->route('admin.menu.index');
    }

    public function store(StoreMenuRequest $request)
    {
        $req = $request->validated();
        $service = $this->serviceRepository->findById($req['service_id']);
        $service->categories()->syncWithoutDetaching([$req['category_id'] => ['position' => $req['position']]]);
        //event(new UserModifiedEvent($service, Events::CREATED));
        $setting_menu_version = (integer)$this->settingRepository->findByKey(Setting::MENU_VERSION);
        $setting_data['key'] = Setting::MENU_VERSION;
        $setting_data['value'] = ++$setting_menu_version;
        $this->settingRepository->update($setting_data);
        //$this->serviceRepository->create($request->validated());
        session()->flash('flash_message', trans('alerts.general.success_add'));
        return redirect()->route('admin.menu.index');
    }

    public function update(UpdateMenuRequest $request, $id)
    {
        $req = $request->validated();
        $service = $this->serviceRepository->findById($req['service_id']);
        //$service->categories()->syncWithoutDetaching([$req['category_id'] => ['position' => $req['position']]]);
        $service->categories()->updateExistingPivot($req['old_category_id'], ['position' => $req['position'], 'category_id' => $req['category_id']]);
        //event(new UserModifiedEvent($service, Events::UPDATED));
        $setting_menu_version = (integer)$this->settingRepository->findByKey(Setting::MENU_VERSION);
        $setting_data['key'] = Setting::MENU_VERSION;
        $setting_data['value'] = ++$setting_menu_version;
        $this->settingRepository->update($setting_data);
        session()->flash('flash_message', trans('alerts.general.success_edit'));
        return redirect()->route('admin.menu.index');
    }
}
