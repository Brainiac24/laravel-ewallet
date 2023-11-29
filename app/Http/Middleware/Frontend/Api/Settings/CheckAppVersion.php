<?php

namespace App\Http\Middleware\Frontend\Api\Settings;

use App\Exceptions\Frontend\Api\NeedToUpgradeException;
use App\Repositories\Backend\Setting\SettingRepositoryContract;
use App\Services\Common\Helpers\Platform;
use App\Services\Common\Helpers\Setting;
use Closure;

class CheckAppVersion
{
    protected $settingRepository;


    public function __construct(SettingRepositoryContract $settingRepository)
    {
        $this->settingRepository = $settingRepository;
    }

    public function handle($request, Closure $next)
    {
        $params = \json_decode($this->settingRepository->findByKey(Setting::APP_VERSION), true);
        $user = \Auth::user();
        $platform = null;

        //dd($params);

        if ($user->devices_json['platform'] == Platform::IOS) {
            $platform = $params['ios'];
        } elseif ($user->devices_json['platform'] == Platform::ANDROID) {
            $platform = $params['android'];
        }

        if ($platform != null) {

            $current_version = explode('.', $platform['version']);
            $user_version = explode('.', $user->devices_json['appVersion']);

            if ($current_version[0] > $user_version[0]) {
                throw new NeedToUpgradeException(trans('setting.errors.major_update'));
            }

            /*
            if ($current_version[1] > $user_version[1]) {
                throw new LogicException(trans('setting.errors.minor_update'));
            }

            if ($current_version[2] > $user_version[2]) {
                throw new LogicException(trans('setting.errors.patch_update'));
            }
            */

        }


        return $next($request);
    }
}
