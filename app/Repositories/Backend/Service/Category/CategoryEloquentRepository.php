<?php
/**
 * Created by PhpStorm.
 * User: F_Kosimov
 * Date: 18.07.2018
 * Time: 15:10
 */

namespace App\Repositories\Backend\Service\Category;

use App\Models\Service\Category\Category;
use App\Repositories\Backend\Service\Category\CategoryRepositoryContract;
use App\Repositories\Backend\Setting\SettingRepositoryContract;
use App\Services\Common\Helpers\Setting;

class CategoryEloquentRepository implements CategoryRepositoryContract
{
    protected $category;
    protected $settingRepository;

    public function __construct(Category $category, SettingRepositoryContract $settingRepository)
    {

        $this->category = $category;
        $this->settingRepository = $settingRepository;

    }

    public function getForDataTable()
    {

    }

    public function all($columns = ['*'])
    {
        $category = $this->category->with('services')->orderBy('created_at', 'desc')->get($columns)->sortBy('position');
        return $category;
    }
    public function allWithoutRelations($columns = ['*'])
    {
        $category = $this->category->select('categories.*','id as recid')->orderBy('created_at', 'desc')->get($columns)->sortBy('position');
        return $category;
    }

    public function paginate($perPage = 30, $columns = ['*'])
    {
        return $this->category->select($columns)->with('services')->orderBy('created_at', 'desc')->paginate($perPage);
    }

    public function listsAll()
    {
        return $this->category->get()->orderBy('created_at', 'desc')->pluck('name', 'id');
    }

    public function create(array $data)
    {
        $category = $this->category->create($data);

        $setting_menu_version = (integer)$this->settingRepository->findByKey(Setting::MENU_VERSION);
        $setting_data['key'] = Setting::MENU_VERSION;
        $setting_data['value'] = ++$setting_menu_version;
        $this->settingRepository->update($setting_data);

        return $category;
    }

    public function findById($id, $columns = ['*'])
    {
        return $this->category->select($columns)->findOrFail($id);
    }

    public function update(array $data, $id)
    {
        $category = $this->category->find($id);
        $category->setOldAttributes($category->getAttributes());
        $category->update($data);

        $setting_menu_version = (integer)$this->settingRepository->findByKey(Setting::MENU_VERSION);
        $setting_data['key'] = Setting::MENU_VERSION;
        $setting_data['value'] = ++$setting_menu_version;
        $this->settingRepository->update($setting_data);

        return $category;
    }

    public function lastLoginUpdate($id)
    {

    }

    public function destroy($id)
    {
        $category = $this->category->findOrFail($id);
        $category->setOldAttributes($category->getAttributes());
        $category->delete();

        $setting_menu_version = (integer)$this->settingRepository->findByKey(Setting::MENU_VERSION);
        $setting_data['key'] = Setting::MENU_VERSION;
        $setting_data['value'] = ++$setting_menu_version;
        $this->settingRepository->update($setting_data);

        return $category;
    }
}