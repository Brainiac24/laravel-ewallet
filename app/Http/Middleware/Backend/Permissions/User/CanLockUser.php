<?php

namespace App\Http\Middleware\Backend\Permissions\User;

use App\Exceptions\Backend\Web\ForbiddenException;
use Closure;

class CanLockUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @throws ForbiddenException
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!\Auth::user()->ability('sadmin','user-lock-manage')) {
            throw new ForbiddenException();
        }

        return $next($request);
    }
}
