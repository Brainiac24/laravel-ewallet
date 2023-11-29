<?php
/**
 * Created by PhpStorm.
 * User: K_Hakimboev
 * Date: 12.07.2018
 * Time: 14:27
 */

namespace App\Services\Common\Auth\Token;

use App\Exceptions\Frontend\Api\UnauthorizedException;
use ReallySimpleJWT\TokenValidator as RTokenValidator;

class TokenValidator
{
    protected $tokenValidator;

    public static function validate(string $token): bool
    {
        return \ReallySimpleJWT\Token::validate($token, config('auth_api.jwt_key'));
    }

    /**
     * @param string $token
     * @return array
     * @throws \ReallySimpleJWT\Exception\TokenValidatorException
     */
    public static function getPayload(string $token): array
    {
        $tokenValidator = new RTokenValidator();

        $tokenValidator->splitToken($token)->validateExpiration()->validateSignature(config('auth_api.jwt_key'));

        $payload = json_decode($tokenValidator->getPayload(), true);

        $payload['data'] = \Crypt::decrypt($payload['data']);

        return $payload;
    }

    /**
     * @param $token
     * @return string
     * @throws UnauthorizedException
     */
    public static function splitToken($token)
    {
        $tokenParts = explode('.', $token);

        if (!isset($tokenParts[0]) || !isset($tokenParts[1]) || !isset($tokenParts[2]))
            throw new UnauthorizedException();

        return sprintf('%s.%s.%s', $tokenParts[0], $tokenParts[1], $tokenParts[2]);
    }

    /**
     * @param $token
     * @return string
     * @throws UnauthorizedException
     */
    public static function splitPinFromToken($token)
    {
        $tokenParts = explode('.', $token);

        if (!isset($tokenParts[3]))
            throw new UnauthorizedException();

        return $tokenParts[3];
    }

}