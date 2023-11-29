<?php

namespace App\Http\Middleware\Backend\Permissions\User\Client;

use App\Exceptions\Backend\Web\ForbiddenException;
use Closure;

class CanIdentificateClient
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
        if (!\Auth::user()->ability('sadmin','client-identificate')) {
            throw new ForbiddenException();
        }

        return $next($request);
    }
}
