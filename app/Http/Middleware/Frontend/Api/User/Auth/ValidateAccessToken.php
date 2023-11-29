<?php

namespace App\Http\Middleware\Frontend\Api\User\Auth;

use App\Exceptions\Frontend\Api\LogicException;
use App\Exceptions\Frontend\Api\UnauthorizedException;
use App\Services\Common\Auth\AuthServiceBaseTrait;
use Closure;

class ValidateAccessToken
{
    use AuthServiceBaseTrait;

    /**
     *
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @throws
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $token = $request->bearerToken();

        $this->validateAccessTokenAndCheckPin($token);

        return $next($request);
    }
}
