<?php

namespace App\Http\Middleware\Backend\Permissions\User\Client;

use App\Exceptions\Backend\Web\ForbiddenException;
use Closure;

class CanEditClient
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
        if (!\Auth::user()->ability('sadmin','client-edit')) {
            throw new ForbiddenException();
        }

        return $next($request);
    }
}
