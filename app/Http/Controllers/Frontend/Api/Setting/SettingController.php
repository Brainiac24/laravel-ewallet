<?php

namespace App\Http\Controllers\Frontend\Api\Setting;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\Api\Setting\SettingNotificationRequest;
use App\Http\Resources\Frontend\Api\Setting\SettingNotificationResource;
use App\Repositories\Frontend\Setting\SettingRepositoryContract;
use App\Repositories\Frontend\User\UserRepositoryContract;
use App\Services\Common\Helpers\Events;
use App\Services\Common\Helpers\HttpStatusCode;
use App\Services\Common\Helpers\Setting;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Auth;

class SettingController extends Controller
{
    protected $settingRepository;
    protected $userRepository;

    public function __construct(SettingRepositoryContract $settingRepository, UserRepositoryContract $userRepository)
    {
        $this->settingRepository = $settingRepository;
        $this->userRepository = $userRepository;
    }

    public function getList()
    {
        $code = 0;
        $params = \json_decode($this->settingRepository->findByKey(Setting::NOTIFICATIONS));
        $data = null;
        foreach ($params as $value) {
            $item = get_object_vars($value);
            if (isset($item['is_enabled']) && $item['is_enabled'] == 1) {
                $data[] = new SettingNotificationResource($value);
            }
        }
        //dd($data);
        return \response()->apiSuccess(compact('code', 'data'));
    }

    public function update(SettingNotificationRequest $request)
    {
        $req = $request->validated();
        $params_notification = \json_decode($this->settingRepository->findByKey(Setting::NOTIFICATIONS));
        $params = Auth::user()->user_settings_json;
        $changed = false;

        foreach ($params_notification as $notification_item) {
            $item = get_object_vars($notification_item);
            //var_dump($item['code']);
            if ($item['code'] == $req['code'] && $item['is_enabled'] == 1) {

                if ($params == null) {
                    $params = [
                        [
                            'code' => $req['code'],
                            'is_active' => (int)$req['is_active'],
                        ],
                    ];
                    $changed = true;
                } else {
                    foreach ($params as &$value) {
                        if (isset($value['code'])) {
                            if ($value['code'] == $req['code']) {
                                $value['is_active'] = (int)$req['is_active'];
                                $changed = true;
                            }
                        }
                    }
                    if (!$changed) {
                        $params[] = [
                            'code' => $req['code'],
                            'is_active' => (int)$req['is_active'],
                        ];
                        $changed = true;
                    }

                }

                $data = [
                    'user_settings_json' => $params,
                ];

                //var_dump($data);
                $user = $this->userRepository->update($data, Auth::user()->id, Events::USER_SETTINGS_NOTIFICATIONS_UPDATED);
            }

        }

        if (!$changed) {
            $code = HttpStatusCode::BAD_REQUEST;
            $message = trans('setting.errors.not_found');
            throw new HttpResponseException(response()->apiError(compact('code', 'message')));
        }

        return \response()->apiSuccess();

    }

}
