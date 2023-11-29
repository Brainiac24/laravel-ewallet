<?php

namespace App\Http\Middleware\Backend\Permissions\Transaction;

use App\Exceptions\Backend\Web\ForbiddenException;
use Closure;

class CanEditTransaction
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @throws ForbiddenException
     * @return mixed
     */
//    public function handle($request, Closure $next)
//    {
//        if (!\Auth::user()->ability('sadmin','transaction-edit')) {
//            throw new ForbiddenException();
//        }
//
//        return $next($request);
//    }

    public function handle($request, Closure $next)
    {
        if (!\Auth::user()->ability(null, 'transaction-edit')) {
            throw new ForbiddenException();
        }

        return $next($request);
    }
}
