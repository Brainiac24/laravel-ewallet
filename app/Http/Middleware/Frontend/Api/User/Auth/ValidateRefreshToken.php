<?php

namespace App\Http\Middleware\Frontend\Api\User\Auth;

use App\Services\Common\Auth\AuthServiceBaseTrait;
use Closure;

class ValidateRefreshToken
{
    use AuthServiceBaseTrait;

    /**
     * @param $request
     * @param Closure $next
     * @return mixed
     * @throws \App\Exceptions\Frontend\Api\AccessForbiddenException
     * @throws \App\Exceptions\Frontend\Api\LogicException
     * @throws \App\Exceptions\Frontend\Api\UnauthorizedException
     * @throws \App\Exceptions\Frontend\Api\ValidationException
     * @throws \App\Exceptions\Frontend\Api\WaitingException
     * @throws \ReallySimpleJWT\Exception\TokenValidatorException
     */
    public function handle($request, Closure $next)
    {
        $token = $request->bearerToken();

        $this->validateRefreshToken($token);

        return $next($request);
    }
}
