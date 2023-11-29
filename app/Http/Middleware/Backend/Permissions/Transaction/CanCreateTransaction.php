<?php

namespace App\Http\Middleware\Backend\Permissions\Transaction;

use App\Exceptions\Backend\Web\ForbiddenException;
use Closure;

class CanCreateTransaction
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
        if (!\Auth::user()->ability('sadmin','transaction-create')) {
            throw new ForbiddenException();
        }

        return $next($request);
    }
}
