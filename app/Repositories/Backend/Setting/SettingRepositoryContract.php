<?php
/**
 * Created by PhpStorm.
 * User: F_Kosimov
 * Date: 18.07.2018
 * Time: 15:10
 */

namespace App\Repositories\Backend\Setting;

use anlutro\LaravelSettings\SettingStore;

interface SettingRepositoryContract
{
    public function all();
    public function create(array $data);
    public function findByKey($key);
    public function update(array $data);
    public function destroy($key);
}