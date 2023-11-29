<?php

namespace App\Http\Middleware\Backend\Permissions\Account\AccountHistory;

use App\Exceptions\Backend\Web\ForbiddenException;
use Closure;

class CanEditAccountHistory
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
        if (!\Auth::user()->ability('sadmin','account-history-edit')) {
            throw new ForbiddenException();
        }

        return $next($request);
    }
}
