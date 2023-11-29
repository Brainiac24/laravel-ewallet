<?php

namespace App\Http\Middleware\Backend\Permissions\SplashScreen;

use App\Exceptions\Backend\Web\ForbiddenException;

class CanShowSplashScreen
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @throws ForbiddenException
     * @return mixed
     */
    public function handle($request, \Closure $next)
    {
        if (!\Auth::user()->ability('sadmin','splash-screen-show')) {
            throw new ForbiddenException();
        }

        return $next($request);
    }
}