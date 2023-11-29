<?php
/**
 * Created by PhpStorm.
 * User: K_Hakimboev
 * Date: 12.07.2018
 * Time: 9:45
 */

namespace App\Services\Common\Auth;

use Carbon\Carbon;

class AuthEntity
{
    protected $token;
    protected $isAuth;
    protected $waitSeconds;
    protected $timeoutConfirmCode;
    protected $timeoutToEnterPin;
    protected $accessToken;
    protected $refreshToken;
    protected $expireInMinutes;
    protected $accessTokenExpireIn;
    protected $refreshTokenExpireIn;
    protected $temporaryToken;
    protected $message;

    /**
     * @return mixed
     */
    public function getAccessTokenExpireIn(): Carbon
    {
        return $this->accessTokenExpireIn;
    }

    /**
     * @param mixed $accessTokenExpireIn
     */
    public function setAccessTokenExpireIn(Carbon $accessTokenExpireIn): void
    {
        $this->accessTokenExpireIn = $accessTokenExpireIn;
    }

    /**
     * @return mixed
     */
    public function getRefreshTokenExpireIn()
    {
        return $this->refreshTokenExpireIn;
    }

    /**
     * @param mixed $refreshTokenExpireIn
     */
    public function setRefreshTokenExpireIn($refreshTokenExpireIn): void
    {
        $this->refreshTokenExpireIn = $refreshTokenExpireIn;
    }


    /**
     * @return mixed
     */
    public function getExpireInMinutes()
    {
        return config('auth_api.ttl_access_token') - 1;
    }

    /**
     * @return mixed
     */
    public function getAccessToken()
    {
        return $this->accessToken;
    }

    /**
     * @param mixed $accessToken
     */
    public function setAccessToken($accessToken)
    {
        $this->accessToken = $accessToken;
    }

    /**
     * @return mixed
     */
    public function getRefreshToken()
    {
        return $this->refreshToken;
    }

    /**
     * @param mixed $refreshToken
     */
    public function setRefreshToken($refreshToken)
    {
        $this->refreshToken = $refreshToken;
    }

    /**
     * @return mixed
     */
    public function getToken(): string
    {
        return $this->token;
    }

    /**
     * @param mixed $token
     */
    public function setToken(string $token)
    {
        $this->token = $token;
    }

    /**
     * @return mixed
     */
    public function getIsAuth(): bool
    {
        return $this->isAuth;
    }

    /**
     * @param mixed $isAuth
     */
    public function setIsAuth(bool $isAuth)
    {
        $this->isAuth = $isAuth;
    }

    /**
     * @return mixed
     */
    public function getWaitSeconds(): int
    {
        return $this->waitSeconds;
    }

    /**
     * @param mixed $waitSeconds
     */
    public function setWaitSeconds(int $waitSeconds)
    {
        $this->waitSeconds = $waitSeconds;
    }

    /**
     * @return mixed
     */
    public function getTimeoutConfirmCode(): int
    {
        return $this->timeoutConfirmCode;
    }

    /**
     * @param mixed $timeoutConfirmCode
     */
    public function setTimeoutConfirmCode(int $timeoutConfirmCode): void
    {
        $this->timeoutConfirmCode = $timeoutConfirmCode;
    }

    /**
     * @return mixed
     */
    public function getTimeoutToEnterPin(): int
    {
        return $this->timeoutToEnterPin;
    }

    /**
     * @param mixed $timeoutToEnterPin
     */
    public function setTimeoutToEnterPin(int $timeoutToEnterPin): void
    {
        $this->timeoutToEnterPin = $timeoutToEnterPin;
    }

    /**
     * @return mixed
     */
    public function getTemporaryToken()
    {
        return $this->temporaryToken;
    }

    /**
     * @param mixed $temporaryToken
     */
    public function setTemporaryToken($temporaryToken): void
    {
        $this->temporaryToken = $temporaryToken;
    }

    /**
     * @return mixed
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param mixed $message
     */
    public function setMessage($message): void
    {
        $this->message = $message;
    }

}