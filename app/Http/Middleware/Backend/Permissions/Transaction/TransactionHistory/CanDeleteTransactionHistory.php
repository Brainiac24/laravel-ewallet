<?php

namespace App\Http\Middleware\Backend\Permissions\Transaction\TransactionHistory;

use App\Exceptions\Backend\Web\ForbiddenException;
use Closure;

class CanDeleteTransactionHistory
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
        if (!\Auth::user()->ability('sadmin','transaction-history-delete')) {
            throw new ForbiddenException();
        }

        return $next($request);
    }
}
