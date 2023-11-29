<?php

namespace App\Http\Middleware\Backend\Permissions\Account\AccountType;

use App\Exceptions\Backend\Web\ForbiddenException;
use Closure;

class CanCreateAccountType
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
        if (!\Auth::user()->ability('sadmin','account-type-create')) {
            throw new ForbiddenException();
        }

        return $next($request);
    }
}
