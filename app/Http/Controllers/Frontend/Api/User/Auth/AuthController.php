<?php

namespace App\Http\Controllers\Frontend\Api\User\Auth;

use App\Exceptions\Frontend\Api\NeedToUpgradeException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\Api\User\Auth\AuthPinRequest;
use App\Http\Requests\Frontend\Api\User\Auth\ChangePinRequest;
use App\Http\Requests\Frontend\Api\User\Auth\HelloAuthRequest;
use App\Http\Requests\Frontend\Api\User\Auth\PushTokenRequest;
use App\Http\Requests\Frontend\Api\User\Auth\RegisterAuthRequest;
use App\Http\Requests\Frontend\Api\User\Auth\RegisterConfirmAuthRequest;
use App\Http\Requests\Frontend\Api\User\Auth\RegisterEmailConfirmRequest;
use App\Http\Requests\Frontend\Api\User\Auth\RegisterEmailRequest;
use App\Http\Requests\Frontend\Api\User\Auth\RegisterPinRequest;
use App\Http\Requests\Frontend\Api\User\Auth\ResetPinConfirmRequest;
use App\Http\Requests\Frontend\Api\User\Auth\ResetRegisterPinRequest;
use App\Http\Resources\Frontend\Api\User\UserMainResource;
use App\Repositories\Frontend\Setting\SettingRepositoryContract;
use App\Services\Common\Auth\AuthService;
use App\Services\Common\Auth\Token\TokenValidator;
use App\Services\Common\Helpers\Attestation;
use App\Services\Common\Helpers\HttpStatusCode;
use App\Services\Common\Helpers\Platform;
use App\Services\Common\Helpers\Setting;
use Illuminate\Container\Container;
use Illuminate\Http\Request;

class AuthController extends Controller
{

    protected $authService;

    /**
     * AuthController constructor.
     *
     * @param $authService ;
     */
    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    /**
     * @param HelloAuthRequest $request
     * @return mixed
     * @throws \App\Exceptions\Frontend\Api\LogicException
     * @throws \App\Exceptions\Frontend\Api\UnauthorizedException
     * @throws \ReallySimpleJWT\Exception\TokenBuilderException
     */
    public function hello(HelloAuthRequest $request)
    {

        $settingRepository = Container::getInstance()->make(SettingRepositoryContract::class);

        $params = \json_decode($settingRepository->findByKey(Setting::APP_VERSION), true);
        $user = $request->device;
        $platform = null;

        //dd($params);

        if ($user['platform'] == Platform::IOS) {
            $platform = $params['ios'];
        } elseif ($user['platform'] == Platform::ANDROID) {
            $platform = $params['android'];
        }

        if ($platform != null) {

            $current_version = explode('.', $platform['version']);
            $user_version = explode('.', $user['appVersion']);

            if ($current_version[0] > $user_version[0]) {
                throw new NeedToUpgradeException(trans('setting.errors.major_update'));
            }

        }


        $data['meta']['temporary_token'] = $this->authService->hello($request->bearerToken(), $request->device);
        $data['meta']['phone'] = config('auth_api.phone');
        $data['code'] = HttpStatusCode::OK;

        return response()->apiSuccess($data);
    }


    public function registerPhone(RegisterAuthRequest $request)
    {
        $token = $request->bearerToken();
        $msisdn = $request->msisdn;

        $data['meta']['temporary_token'] = $this->authService->phone->register($token, $msisdn);
        $data['meta']['wait_settings'] = config('auth_api.sms.waiting_to_retry_send');
        $data['meta']['timeout_confirm_code'] = config('auth_api.sms.timeout_confirm_code');
        $data['code'] = HttpStatusCode::OK;

        return response()->apiSuccess($data);
    }


    public function registerPhoneConfirm(RegisterConfirmAuthRequest $request)
    {
        $token = $request->bearerToken();
        $hashCode = $request->hash_code;

        $auth = $this->authService->phone->registerConfirm($token, $hashCode);

        $data['meta']['temporary_token'] = $auth->getToken();
        $data['meta']['is_auth'] = $auth->getIsAuth();
        ($auth->getIsAuth() == true) ?: $data['meta']['timeout_to_enter_pin'] = config('auth_api.pin.timeout_to_enter_pin');
        $data['code'] = HttpStatusCode::OK;

        return response()->apiSuccess($data);
    }


    public function registerPin(RegisterPinRequest $request)
    {
        $auth = $this->authService->pin->register($request->bearerToken(), $request->code);

        $settingRepository = Container::getInstance()->make(SettingRepositoryContract::class);


        $data['data'] = new UserMainResource(\Auth::user()->load('accounts'));
        $data['meta']['is_editable'] = \Auth::user()->attestation_id == Attestation::NOT_IDENTIFIED ? 1 : 0;
        if (\Auth::user()->verification_params_json['is_verified'] == 2) {
            $data['meta']['is_editable'] = 2;
        }
        $data['meta']['menu_version'] = $settingRepository->findByKey(Setting::MENU_VERSION);
        $data['meta']['push_token'] = \Auth::user()->push_token;
        $data['meta']['access_token'] = $auth->getAccessToken();
        $data['meta']['refresh_token'] = $auth->getRefreshToken();
        $data['meta']['expire_in'] = $auth->getExpireInMinutes();
        $data['code'] = HttpStatusCode::OK;

        return response()->apiSuccess($data);
    }


    public function authPin(AuthPinRequest $request)
    {
        $auth = $this->authService->pin->auth($request->bearerToken(), $request->hash_code);

        $settingRepository = Container::getInstance()->make(SettingRepositoryContract::class);

        $data['data'] = new UserMainResource(\Auth::user()->load('accounts'));
        $data['meta']['is_editable'] = \Auth::user()->attestation_id == Attestation::NOT_IDENTIFIED ? 1 : 0;
        if (\Auth::user()->verification_params_json['is_verified'] == 2) {
            $data['meta']['is_editable'] = 2;
        }
        $data['meta']['menu_version'] = $settingRepository->findByKey(Setting::MENU_VERSION);
        $data['meta']['push_token'] = \Auth::user()->push_token;
        $data['meta']['access_token'] = $auth->getAccessToken();
        $data['meta']['refresh_token'] = $auth->getRefreshToken();
        $data['meta']['expire_in'] = $auth->getExpireInMinutes();

        $data['code'] = HttpStatusCode::OK;

        return response()->apiSuccess($data);
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function logout()
    {
        $this->authService->logout();

        $data['code'] = HttpStatusCode::OK;

        return response()->apiSuccess($data);
    }

    /**
     * @return mixed
     * @throws \ReallySimpleJWT\Exception\TokenBuilderException
     */
    public function refreshToken()
    {
        $auth = $this->authService->refreshToken();

        $data['meta']['push_token'] = \Auth::user()->push_token;
        $data['meta']['access_token'] = $auth->getAccessToken();
        $data['meta']['refresh_token'] = $auth->getRefreshToken();
        $data['meta']['expire_in'] = $auth->getExpireInMinutes();

        $data['code'] = HttpStatusCode::OK;

        return response()->apiSuccess($data);
    }

    /**
     * @param ChangePinRequest $request
     * @return mixed
     * @throws \App\Exceptions\Frontend\Api\UnauthorizedException
     */
    public function changePin(ChangePinRequest $request)
    {
        $token = TokenValidator::splitToken($request->bearerToken());
        $result = $this->authService->pin->change($token, $request->old_hash_code, $request->new_code);

        if ($result === true) {
            $data['code'] = HttpStatusCode::OK;
        } else {
            $data['code'] = HttpStatusCode::BAD_REQUEST;
            $data['message'] = trans('auth.error_change_pin');
        }
        return response()->apiSuccess($data);
    }

    /**
     * @param RegisterEmailRequest $request
     * @return mixed
     */
    public function registerEmail(RegisterEmailRequest $request)
    {
        $this->authService->email->register($request->email);

        $data['code'] = HttpStatusCode::OK;
        $data['message'] = trans('auth.sent_email');
        $data['meta']['timeout_confirm_code'] = config('auth_api.email.timeout_confirm_code');
        return response()->apiSuccess($data);
    }

    /**
     * @param RegisterEmailConfirmRequest $request
     * @return mixed
     * @throws \App\Exceptions\Frontend\Api\UnauthorizedException
     */
    public function registerEmailConfirm(RegisterEmailConfirmRequest $request)
    {
        $token = TokenValidator::splitToken($request->bearerToken());
        $this->authService->email->registerConfirm($token, $request->hash_code);

        $data['code'] = HttpStatusCode::OK;
        return response()->apiSuccess($data);
    }

    public function resetPin(Request $request)
    {
        $token = $request->bearerToken();

        $auth = $this->authService->pin->reset($token);

        $data['message'] = $auth->getMessage();
        $data['meta']['temporary_token'] = $auth->getTemporaryToken();
        $data['meta']['wait_settings'] = $auth->getWaitSeconds();
        $data['meta']['timeout_confirm_code'] = $auth->getTimeoutConfirmCode();
        $data['code'] = HttpStatusCode::OK;

        return response()->apiSuccess($data);
    }

    public function resetPinConfirm(ResetPinConfirmRequest $request)
    {
        $token = $request->bearerToken();

        $auth = $this->authService->pin->resetConfirm($token, $request->hash_code);

        $data['meta']['temporary_token'] = $auth->getTemporaryToken();
        $data['meta']['timeout_to_enter_pin'] = $auth->getTimeoutToEnterPin();
        $data['code'] = HttpStatusCode::OK;

        return response()->apiSuccess($data);
    }

    public function resetRegisterPin(ResetRegisterPinRequest $request)
    {
        $token = $request->bearerToken();

        $auth = $this->authService->pin->resetRegister($token, $request->code);

        $settingRepository = Container::getInstance()->make(SettingRepositoryContract::class);

        $data['data'] = new UserMainResource(\Auth::user()->load('accounts'));
        $data['meta']['menu_version'] = $settingRepository->findByKey(Setting::MENU_VERSION);
        $data['meta']['push_token'] = \Auth::user()->push_token;
        $data['meta']['access_token'] = $auth->getAccessToken();
        $data['meta']['refresh_token'] = $auth->getRefreshToken();
        $data['meta']['expire_in'] = $auth->getExpireInMinutes();
        $data['meta']['is_editable'] = \Auth::user()->attestation_id == Attestation::NOT_IDENTIFIED ? 1 : 0;
        if (\Auth::user()->verification_params_json['is_verified'] == 2) {
            $data['meta']['is_editable'] = 2;
        }

        $data['code'] = HttpStatusCode::OK;

        return response()->apiSuccess($data);
    }

    public function pushToken(PushTokenRequest $request)
    {
        $this->authService->setPushToken($request->token);
        $data['code'] = HttpStatusCode::OK;

        return response()->apiSuccess($data);
    }
}
