<?php

namespace App\Http\Middleware\Frontend\Api\User\Auth;

use App\Exceptions\Frontend\Api\UnauthorizedException;
use Closure;

class CheckExistToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @throws
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
//       throw new LogicException('test exception');

        if (!$request->ajax())
            throw new UnauthorizedException();

        if ($request->header('user-agent') !== 'MBE')
            throw new UnauthorizedException();
        //dd($request->bearerToken());
        if (empty($request->bearerToken()))
            throw new UnauthorizedException();

        return $next($request);
    }
}
