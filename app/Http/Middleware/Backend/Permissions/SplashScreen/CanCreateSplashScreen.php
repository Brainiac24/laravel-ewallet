<?php


namespace App\Http\Middleware\Backend\Permissions\SplashScreen;


use App\Exceptions\Backend\Web\ForbiddenException;

class CanCreateSplashScreen
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
        if (!\Auth::user()->ability('sadmin','splash-screen-create')) {
            throw new ForbiddenException();
        }

        return $next($request);
    }
}