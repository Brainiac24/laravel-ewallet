<?php
/**
 * Created by PhpStorm.
 * User: F_Kosimov
 * Date: 18.07.2018
 * Time: 15:10
 */

namespace App\Repositories\Backend\Setting;


use anlutro\LaravelSettings\SettingStore;
use App\Events\Backend\User\UserHistory\UserModifiedForSettingEvent;
use App\Services\Common\Helpers\Events;
use Exception;

class SettingEloquentRepository implements SettingRepositoryContract
{
    protected $setting;

    public function __construct(SettingStore $setting)
    {
        $this->setting = $setting;
    }

    public function all()
    {
        return $this->setting->all();
    }

    public function create(array $data)
    {
        $item = $this->findByKey($data['key']);
        if ($item == null) {
            $this->setting->set($data['key'], $data['value']);
            $this->setting->save();
        }

        event(new UserModifiedForSettingEvent(null, $data, 'anlutro\LaravelSettings\SettingStore', $data['key'], Events::CREATED));

        return true;

    }

    public function findByKey($key)
    {
        return $this->setting->get($key);
    }

    public function update(array $data)
    {
        $setting = null;
        try {
            $setting = $this->findByKey($data['key']);
        } catch (Exception $e) {
        }
        
        $this->setting->set($data['key'], $data['value']);
        $this->setting->save();

        event(new UserModifiedForSettingEvent(['key' => $data['key'], 'value' => $setting], $data, 'anlutro\LaravelSettings\SettingStore', $data['key'], Events::UPDATED));
        //dd($this->setting);

        return true;
    }

    public function destroy($key)
    {
        $setting = null;
        try {
            $setting = $this->findByKey($key);
        } catch (Exception $e) {
        }
        event(new UserModifiedForSettingEvent(['key' => $key, 'value' => $setting], null, 'anlutro\LaravelSettings\SettingStore', $key, Events::DELETED));
        $this->setting->forget($key);
        $this->setting->save();
        return true;
    }

}
