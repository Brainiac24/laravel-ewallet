<?php

namespace App\Http\Controllers\Frontend\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\Api\User\UpdateUserRequest;
use App\Http\Resources\Frontend\Api\User\UserFullResource;
use App\Http\Resources\Frontend\Api\User\UserMainResource;
use App\Repositories\Frontend\Setting\SettingRepositoryContract;
use App\Repositories\Frontend\User\UserRepositoryContract;
use App\Services\Common\Helpers\Attestation;
use App\Services\Common\Helpers\HttpStatusCode;
use App\Services\Common\Helpers\Platform;
use App\Services\Common\Helpers\Setting;
use App\Services\Common\Image\ImageServiceContract;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    protected $userRepository;
    protected $settingRepository;
    protected $imageService;

    public function __construct(UserRepositoryContract $userRepository, SettingRepositoryContract $settingRepository, ImageServiceContract $imageService)
    {
        $this->userRepository = $userRepository;
        $this->settingRepository = $settingRepository;
        $this->imageService = $imageService;
    }

    public function update(UpdateUserRequest $request)
    {
        $data = $request->validated();
        //ХАРДКОД - не оптимизированный код двойное сохранение

        $is_verified = Auth::user()->verification_params_json['is_verified'] ?? 0;

        if (Auth::user()->attestation_id == Attestation::NOT_IDENTIFIED && $is_verified == 0 && (isset($data['date_birth']) || isset($data['gender']) || isset($data['first_name']) || isset($data['last_name']) || isset($data['middle_name']))) {

            if (isset($data['photo'])) {
                $photo = $data['photo'];
                $data['photo'] = url('/') . '/imgs/users/400x/' . $this->imageService->save(config('image.public_dir_imgs_users'), $photo)->basename;
            }

            if (isset($data['date_birth'])) {

                $data['contacts_json'] = Auth::user()->contacts_json;
                $data['contacts_json']['date_birth'] = $data['date_birth'];
                unset($data['date_birth']);

            }
            if (isset($data['gender'])) {
                if (isset($data['contacts_json'])) {
                    $data['contacts_json']['gender'] = $data['gender'];
                } else {
                    $data['contacts_json'] = Auth::user()->contacts_json;
                    $data['contacts_json']['gender'] = $data['gender'];
                }
                unset($data['gender']);
            }
            //dd( $data);

            $user = $this->userRepository->update($data, Auth::user()->id);
            //dd($user);
            $data = new UserMainResource($user);
            $code = 0;
            return \response()->apiSuccess(compact('code', 'data', 'meta'));
        } else if (isset($data['photo']) && !isset($data['date_birth']) && !isset($data['gender']) && !isset($data['first_name']) && !isset($data['last_name']) && !isset($data['middle_name'])) {
            $photo = $data['photo'];
            $data = [];
            $data['photo'] = url('/') . '/imgs/users/400x/' . $this->imageService->save(config('image.public_dir_imgs_users'), $photo)->basename;

            Auth::user()->photo = $data['photo'];
            Auth::user()->save();
            $data = new UserMainResource(Auth::user());
            return \response()->apiSuccess(compact('code', 'data', 'meta'));
        } else {
            $code = 6;
            $message = trans('users.errors.profile_change_access_denied');
            return \response()->apiError(compact('code', 'message'));
        }
    }

    public function getMainData()
    {
        $code = HttpStatusCode::OK;
        $user = Auth::user()->load('accounts');
        $data = new UserMainResource($user);

        $params = \json_decode($this->settingRepository->findByKey(Setting::APP_VERSION), true);
        //dd($params);
        $platform = null;

        if ($user->devices_json['platform'] == Platform::IOS) {
            $platform = $params['ios'];
        } elseif ($user->devices_json['platform'] == Platform::ANDROID) {
            $platform = $params['android'];
        }

        $meta = [
            'menu_version' => $this->settingRepository->findByKey(Setting::MENU_VERSION),
            'app_version' => $platform['version'],
            'is_editable' => $user->attestation_id == Attestation::NOT_IDENTIFIED ? 1 : 0,
        ];
        if ($user->verification_params_json['is_verified'] == 2) {$meta['is_editable'] = 2;}
        return \response()->apiSuccess(compact('code', 'data', 'meta'));
    }

    public function getFullData()
    {
        $code = HttpStatusCode::OK;
        $user = Auth::user()->load('accounts','document_type');
        $data = new UserFullResource($user);
        $params = \json_decode($this->settingRepository->findByKey(Setting::APP_VERSION), true);
        $platform = null;
        if ($user->devices_json['platform'] == Platform::IOS) {
            $platform = $params['ios'];
        } elseif ($user->devices_json['platform'] == Platform::ANDROID) {
            $platform = $params['android'];
        }
        $meta = [
            'menu_version' => $this->settingRepository->findByKey(Setting::MENU_VERSION),
            'app_version' => $platform['version'],
            'is_editable' => (int) 0,
        ];
        return \response()->apiSuccess(compact('code', 'data', 'meta'));
    }

    /*
public function index()
{
$users = $this->userRepository->paginate();
//$data = UserResource::collection($users);
$data = UserResource::collection($users);

return \response()->apiSuccess(compact('data'));
}

public function store(StoreUserRequest $request)
{
$user = $this->userRepository->create($request->validated());

$data = UserResource::make($user);

return \response()->apiSuccess(compact('data'));
}

public function show($id)
{
$user = $this->userRepository->findById($id);

$data = UserResource::make($user);

return \response()->apiSuccess(compact('data'));
}

public function destroy($id)
{

}
 */

}
