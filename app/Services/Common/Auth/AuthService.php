<?php
/**
 * Created by PhpStorm.
 * User: K_Hakimboev
 * Date: 12.07.2018
 * Time: 9:45
 */

namespace App\Services\Common\Auth;


use App\Events\Frontend\User\UserLogoutEvent;
use App\Events\Frontend\User\UserRefreshedTokenEvent;
use App\Repositories\Frontend\User\UserSession\UserSessionRepositoryContract;
use App\Services\Common\Auth\Email\EmailAuthServiceContract;
use App\Services\Common\Auth\Helpers\Step;
use App\Services\Common\Auth\Phone\PhoneAuthServiceContract;
use App\Services\Common\Auth\Pin\PinAuthServiceContract;
use App\Services\Common\Auth\Token\Token;
use Illuminate\Container\Container;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;

class AuthService extends AuthServiceBase
{
    public $phone;
    public $pin;
    public $email;

    public function __construct(PhoneAuthServiceContract $phoneService, PinAuthServiceContract $pinAuthService, EmailAuthServiceContract $emailAuthService)
    {
        $this->phone = $phoneService;
        $this->pin = $pinAuthService;
        $this->email = $emailAuthService;
    }

    /**
     * @param string $token
     * @param array $deviceParams
     * @return string
     * @throws \App\Exceptions\Frontend\Api\LogicException
     * @throws \App\Exceptions\Frontend\Api\UnauthorizedException
     * @throws \ReallySimpleJWT\Exception\TokenBuilderException
     */
    public function hello(string $token, array $deviceParams): string
    {
        $payload = [
            'step' => Step::REGISTER_PHONE,
            'device' => $deviceParams
        ];

        $this->checkHashTokenForHello($token, $deviceParams);

        $tokenBuilder = new Token($payload);
        return $tokenBuilder->makeTemporaryToken();
    }

    /**
     * @throws \Exception
     */
    public function logout()
    {
        \DB::beginTransaction();

        try {
            $session = Container::getInstance()->make(UserSessionRepositoryContract::class);
            $userSession = $session->revokeByAuth();

            Event::dispatch(new UserLogoutEvent($userSession));

            \DB::commit();

        } catch (\PDOException $exception) {
            \DB::rollBack();
            \Log::error($exception);
            throw $exception;
        }
    }

    /**
     * @throws \ReallySimpleJWT\Exception\TokenBuilderException
     */
    public function refreshToken(): AuthEntity
    {
        $payload = [
            'user_id' => Auth::id(),
            'device_id' => Auth::user()->devices_json['id'],
        ];

        $tokenBuilder = new Token($payload);
        $authEntity = new AuthEntity();
        $authEntity->setAccessToken($tokenBuilder->makeAccessToken());
        $authEntity->setAccessTokenExpireIn($tokenBuilder->getExpiration());
        $authEntity->setRefreshToken($tokenBuilder->makeRefreshToken());
        $authEntity->setRefreshTokenExpireIn($tokenBuilder->getExpiration());

        Event::dispatch(new UserRefreshedTokenEvent(Auth::user(), $authEntity));

        return $authEntity;

    }

    /**
     * @param $token
     * @return bool
     */
    public function setPushToken($token)
    {
        return $this->savePushToken(Auth::user(), $token);
    }

}