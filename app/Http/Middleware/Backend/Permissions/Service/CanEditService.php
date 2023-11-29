<?php

namespace App\Http\Middleware\Backend\Permissions\Service;

use App\Exceptions\Backend\Web\ForbiddenException;
use Closure;

class CanEditService
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
        if (!\Auth::user()->ability('sadmin','service-edit')) {
            throw new ForbiddenException();
        }

        return $next($request);
    }
}
