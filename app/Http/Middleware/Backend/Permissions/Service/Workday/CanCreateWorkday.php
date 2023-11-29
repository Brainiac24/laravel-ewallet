<?php

namespace App\Http\Middleware\Backend\Permissions\Service\Workday;

use App\Exceptions\Backend\Web\ForbiddenException;
use Closure;

class CanCreateWorkday
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
        if (!\Auth::user()->ability('sadmin','service-workday-create')) {
            throw new ForbiddenException();
        }

        return $next($request);
    }
}
