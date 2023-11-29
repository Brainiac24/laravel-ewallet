<?php

namespace App\Http\Middleware\Backend\Permissions\Account;

use App\Exceptions\Backend\Web\ForbiddenException;
use Closure;

class CanListAccount
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
        if (!\Auth::user()->ability('sadmin','account-list')) {
            throw new ForbiddenException();
        }

        return $next($request);
    }
}
