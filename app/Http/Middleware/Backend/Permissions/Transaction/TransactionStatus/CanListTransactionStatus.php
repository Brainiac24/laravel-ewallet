<?php

namespace App\Http\Middleware\Backend\Permissions\Transaction\TransactionStatus;

use App\Exceptions\Backend\Web\ForbiddenException;
use Closure;

class CanListTransactionStatus
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
        if (!\Auth::user()->ability('sadmin','transaction-status-list')) {
            throw new ForbiddenException();
        }

        return $next($request);
    }
}
