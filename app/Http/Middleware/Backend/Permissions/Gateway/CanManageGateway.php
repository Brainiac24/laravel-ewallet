<?php

namespace App\Http\Middleware\Backend\Permissions\Gateway;

use App\Exceptions\Backend\Web\ForbiddenException;
use Closure;

class CanManageGateway
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
        if (!\Auth::user()->ability('sadmin','gateways')) {
            throw new ForbiddenException();
        }

        return $next($request);
    }
}
