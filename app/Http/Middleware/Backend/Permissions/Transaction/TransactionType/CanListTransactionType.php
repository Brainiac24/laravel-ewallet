<?php

namespace App\Http\Middleware\Backend\Permissions\Transaction\TransactionType;

use App\Exceptions\Backend\Web\ForbiddenException;
use Closure;

class CanListTransactionType
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
        if (!\Auth::user()->ability('sadmin','transaction-type-list')) {
            throw new ForbiddenException();
        }

        return $next($request);
    }
}
