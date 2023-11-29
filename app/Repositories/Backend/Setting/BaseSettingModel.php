<?php

namespace App\Repositories\Backend\Setting;

use anlutro\LaravelSettings\SettingsManager;

class BaseSettingModel extends SettingsManager
{

    private $old_attributes = null;
    private $changed_params = null;

    public function getOldAttributes()
    {
        return $this->old_attributes;
    }

    public function setOldAttributes($old_attributes)
    {
        $this->old_attributes = $old_attributes;
    }

    public function getChanges()
    {
        return $this->changed_params;
    }

    public function setChanges($changed_params)
    {
        $this->changed_params = $changed_params;
    }


    
}