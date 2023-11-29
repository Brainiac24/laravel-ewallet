<?php
/**
 * Created by PhpStorm.
 * User: F_Kosimov
 * Date: 18.07.2018
 * Time: 15:10
 */

namespace App\Repositories\Frontend\Setting;

use anlutro\LaravelSettings\SettingStore;

interface SettingRepositoryContract
{
    public function all();
    public function findByKey($key);

    public function findByKeyAndLockForUpdate($key);
}