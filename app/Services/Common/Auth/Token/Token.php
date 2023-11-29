<?php
/**
 * Created by PhpStorm.
 * User: K_Hakimboev
 * Date: 12.07.2018
 * Time: 14:27
 */

namespace App\Services\Common\Auth\Token;


use Carbon\Carbon;
use ReallySimpleJWT\TokenBuilder;

class Token
{
    protected $tokenBuilder;
    protected $tokenValidator;

    private $payload;
    private $expiration;

    /**
     * Token constructor.
     */
    public function __construct(array $payload)
    {
        $this->tokenBuilder = new TokenBuilder();

        $this->setPayload($payload);

    }

    /**
     * @return string
     * @throws \ReallySimpleJWT\Exception\TokenBuilderException
     */
    public function makeTemporaryToken(): string
    {
        $builder = $this->tokenBuilder->addPayload(['key' => 'data', 'value' => $this->getPayload()]);

        $expireIn = Carbon::now()->addMinute(config('auth_api.ttl_temporary_token'));

        $this->expiration = $expireIn;

        return $builder->setSecret(config('auth_api.jwt_key'))
            ->setIssuer(config('auth_api.issuer'))
            ->setExpiration(Carbon::now()->addMinute(config('auth_api.ttl_temporary_token'))->timestamp)
            ->build();
    }

    /**
     * @return string
     * @throws \ReallySimpleJWT\Exception\TokenBuilderException
     */
    public function makeAccessToken(): string
    {
        $builder = $this->tokenBuilder->addPayload(['key' => 'data', 'value' => $this->getPayload()]);

        $expireIn = Carbon::now()->addMinute(config('auth_api.ttl_access_token'));

        $this->expiration = $expireIn;

        return $builder->setSecret(config('auth_api.jwt_key'))
            ->setIssuer(config('auth_api.issuer'))
            ->setExpiration($expireIn)
            ->build();
    }

    /**
     * @return string
     * @throws \ReallySimpleJWT\Exception\TokenBuilderException
     */
    public function makeRefreshToken(): string
    {
        $builder = $this->tokenBuilder->addPayload(['key' => 'data', 'value' => $this->getPayload()]);

        $expireIn = Carbon::now()->addMinute(config('auth_api.ttl_refresh_token'));
        $this->expiration = $expireIn;

        return $builder->setSecret(config('auth_api.jwt_key'))
            ->setIssuer(config('auth_api.issuer'))
            ->setExpiration(Carbon::now()->addMinute(config('auth_api.ttl_refresh_token'))->timestamp)
            ->build();
    }

    /**
     * @return Carbon
     * @throws \ReallySimpleJWT\Exception\TokenBuilderException
     */
    public function getExpiration(): Carbon
    {
        return $this->expiration;
    }

    /**
     * @return mixed
     */
    protected function getPayload()
    {
        return $this->payload;
    }

    /**
     * @param mixed $payload
     */
    protected function setPayload($payload)
    {
        $this->payload = \Crypt::encrypt($payload);
        //$this->payload = \Crypt::encrypt($payload);
    }


}