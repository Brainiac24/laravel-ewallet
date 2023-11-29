<?php
/**
 * Created by PhpStorm.
 * User: F_Kosimov
 * Date: 18.07.2018
 * Time: 15:10
 */

namespace App\Repositories\Frontend\Setting;

use anlutro\LaravelSettings\SettingStore;
use App\Models\Setting\Setting;

class SettingEloquentRepository implements SettingRepositoryContract
{
    protected $setting;
    protected $setting_model;

    public function __construct(SettingStore $setting, Setting $setting_model)
    {
        $this->setting = $setting;
        $this->setting_model = $setting_model;
    }

    public function all()
    {
        return $this->setting->all();
    }

    public function findByKey($key)
    {
        return $this->setting->get($key);
    }

    public function findByKeyAndLockForUpdate($key)
    {
        return $this->setting_model->where('key',$key)->lockForUpdate()->first();
    }


}