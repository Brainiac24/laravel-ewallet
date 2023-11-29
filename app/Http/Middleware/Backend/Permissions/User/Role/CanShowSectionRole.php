<?php

namespace App\Http\Middleware\Backend\Permissions\User\Role;

use App\Exceptions\Backend\Web\ForbiddenException;
use Closure;

class CanShowSectionRole
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
        if (!\Auth::user()->ability('sadmin','roles')) {
            throw new ForbiddenException();
        }

        return $next($request);
    }
}
