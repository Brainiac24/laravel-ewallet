<?php
/**
 * Created by PhpStorm.
 * User: K_Hakimboev
 * Date: 12.07.2018
 * Time: 9:45
 */

namespace App\Services\Common\Auth;

use App\Exceptions\Frontend\Api\AccessForbiddenException;
use App\Exceptions\Frontend\Api\LogicException;
use App\Exceptions\Frontend\Api\RefreshTokenExpiredException;
use App\Exceptions\Frontend\Api\UnauthorizedException;
use App\Exceptions\Frontend\Api\ValidationException;
use App\Exceptions\Frontend\Api\WaitingException;
use App\Models\User\User;
use App\Repositories\Frontend\User\UserRepositoryContract;
use App\Services\Common\Auth\Token\TokenValidator;
use App\Services\Common\Helpers\Platform;
use Carbon\Carbon;
use Illuminate\Container\Container;
use ReallySimpleJWT\Exception\TokenValidatorException;

trait AuthServiceBaseTrait
{
    /**
     * @param $token
     * @param null $routeAliasName
     * @throws AccessForbiddenException
     * @throws LogicException
     * @throws UnauthorizedException
     * @throws ValidationException
     * @throws WaitingException
     * @throws \Exception
     * @throws \ReallySimpleJWT\Exception\TokenValidatorException
     */
    public function validateAccessTokenAndCheckPin($token)
    {
        $newToken = $this->validateTokenAndLoginUsingId($token);

        $hashPin = TokenValidator::splitPinFromToken($token);
        $this->checkAccessToken(\Auth::user(), $newToken);
        $this->checkHashPinWithBase64(\Auth::user(), $hashPin, $newToken, \Auth::user()->pin, \Auth::user()->devices_json['id'], \Auth::user()->devices_json['platform']);
        $this->resetBlockCount(\Auth::user());
    }

    /**
     * @param $token
     * @throws AccessForbiddenException
     * @throws LogicException
     * @throws RefreshTokenExpiredException
     * @throws UnauthorizedException
     * @throws WaitingException
     */
    public function validateRefreshToken($token)
    {
        try {
            $newToken = $this->validateTokenAndLoginUsingId($token);
            $this->checkRefreshToken(\Auth::user(), $newToken);
        } catch (TokenValidatorException $e) {
            throw new RefreshTokenExpiredException();
        }

    }

    /**
     * @param $token
     * @return string
     * @throws AccessForbiddenException
     * @throws LogicException
     * @throws UnauthorizedException
     * @throws WaitingException
     * @throws \ReallySimpleJWT\Exception\TokenValidatorException
     */
    protected function validateTokenAndLoginUsingId($token): string
    {
        if (empty($token)) {
            throw new UnauthorizedException();
        }

        //parts index 0,1,2 - token, parts index 3 - is additional hash pin
        $newToken = TokenValidator::splitToken($token);

        $payload = $this->getPayload($newToken);

        if (!isset($payload['data']['user_id']))
            throw new LogicException('Пользователь не найден!');

        $user = \Auth::loginUsingId($payload['data']['user_id']);

        if (!\Auth::check())
            throw new UnauthorizedException();

        $this->isActive(\Auth::user());
        $this->isUserBlocked(\Auth::user());
        $this->isNotAdmin(\Auth::user());

        return $newToken;
    }

    /**
     * @param string $token
     * @param string $code
     * @param string $deviceId
     * @param bool $platform
     * @return string
     * @throws \Exception
     */
    protected function makeHashWithBase64(string $token, string $code, string $deviceId, bool $platform): string
    {
        return base64_encode($this->makeHash($token, $code, $deviceId, $platform));
    }

    /**
     * @param string $token
     * @param string $code
     * @param string $deviceId
     * @param bool $platform
     * @return string
     * @throws \Exception
     */
    protected function makeHash(string $token, string $code, string $deviceId, bool $platform): string
    {
        $key = $this->getAppKey($platform);

        return hash('sha256', sprintf('%s:%s:%s:%s', $token, $code, $deviceId, $key));
    }

    /**
     * @param bool $platform
     * @return string
     * @throws LogicException
     */
    protected function getAppKey(bool $platform): string
    {
        $key = null;
        switch ($platform) {
            case Platform::IOS:
                $key = config('auth_api.ios_key');
                break;
            case Platform::ANDROID:
                $key = config('auth_api.android_key');
                break;
        }

        if (strlen($key) !== 32)
            throw new LogicException('App key length incorrect');

        return $key;
    }

    protected function savePushToken(User $user, $token)
    {
        $devices = $user->devices_json;
        $devices ['push_token'] = $token;
        $user->devices_json = $devices;
        return $user->save();
    }

    /**
     * @param  object $user
     * @return object
     */
    protected function blockUser(object $user)
    {
        if ($user instanceof User) {
            $user->pin_confirm_try_count = 0;
            $user->email_confirm_try_count = 0;
        }

        $now = Carbon::now();
        $user->blocked_count += 1;
        $user->sms_confirm_try_count = 0;
        $user->blocked_at = $now;
        $user->unblock_at = $now->addMinutes(($user->blocked_count * $user->blocked_count) * config('auth_api.sms.interval_lock'));
        $user->ip = \Request::ip();
//        $user->user_agent = \Request::header('User-Agent');
        $user->save();

        return $user;
    }

    public function resetBlockCount(User $user)
    {
        $user->blocked_count = 0;
        $user->pin_confirm_try_count = 0;
        return $user->save();
    }

    /**
     * Проверяем валидность токена и получаем полезные данные для проверки step
     *
     * @param string $token
     * @param int|null $step
     * @return array
     * @throws LogicException
     * @throws \ReallySimpleJWT\Exception\TokenValidatorException
     */
    protected function getPayload(string $token, int $step = null): array
    {
        $payload = TokenValidator::getPayload($token);

        if ($step !== null) {
            if (!isset($payload['data']['step']) || $payload['data']['step'] !== $step)
                throw new LogicException('Incorrect step');
        }

        return $payload;
    }

    /**
     * @param $user
     * @throws AccessForbiddenException
     */
    protected function isActive($user)
    {
        if ($user->is_active === false)
            throw new AccessForbiddenException(trans('auth.blocked'));
    }

    /**
     * @param $user
     * @return bool
     */
    protected function isNotAdmin($user): bool
    {
        return $user->is_admin !== true;
    }

    /**
     * @param $user
     * @throws WaitingException
     */
    protected function isUserBlocked($user)
    {
        $now = Carbon::now();
        if ($now->diffInSeconds($user->unblock_at, false) > 0)
            throw new WaitingException(trans('auth.temporary_blocked', ['attribute' => $now->diffForHumans($user->unblock_at, true)]));
    }

    /**
     * @param User $user
     * @param $token
     * @throws UnauthorizedException
     */
    protected function checkAccessToken(User $user, $token)
    {
        $session = $user->load('user_session');
        if ($session == null)
            throw new UnauthorizedException();

        if ($session->user_session->access_token !== $token)
            throw new UnauthorizedException();
    }

    /**
     * @param User $user
     * @param $token
     * @throws UnauthorizedException
     */
    protected function checkRefreshToken(User $user, $token)
    {
        $session = $user->load('user_session');

        if ($session->user_session == null)
            throw new UnauthorizedException();

        if ($session->user_session->refresh_token !== $token)
            throw new UnauthorizedException();
    }

    protected function routeIsRefresh($route)
    {
        return $route === 'auth.refresh';
    }

    /**
     * @param string $hashPin
     * @param User $user
     * @param string $token
     * @param string $pin
     * @param string $deviceId
     * @param string $platform
     * @throws ValidationException
     * @throws \Exception
     */
    protected function checkHashPinWithBase64(User $user, string $hashPin, string $token, string $pin, string $deviceId, string $platform)
    {
        if ($hashPin !== $this->makeHashWithBase64($token, $pin, $deviceId, $platform)) {
            $userRepository = Container::getInstance()->make(UserRepositoryContract::class);
            $userRepository->incrementPinConfirmTryCount($user);

            $this->checkLimitPinConfirmTryCount($user);
            throw new ValidationException(trans('auth.failed_pin_code_confirm', ['attribute' => \Auth::user()->pin_confirm_try_count_left]));
        }

    }

    /**
     * @param $user
     * @throws WaitingException
     */
    protected function checkLimitPinConfirmTryCount($user)
    {
        if (config('auth_api.pin.confirm_try_count') <= $user->pin_confirm_try_count) {
            $user = $this->blockUser($user);
            throw new WaitingException(trans('auth.temporary_blocked_pin', ['attribute' => Carbon::now()->diffForHumans($user->unblock_at, true)]));
        }
    }

}