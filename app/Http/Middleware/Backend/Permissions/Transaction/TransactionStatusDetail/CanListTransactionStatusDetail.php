<?php

namespace App\Http\Middleware\Backend\Permissions\Transaction\TransactionStatusDetail;

use App\Exceptions\Backend\Web\ForbiddenException;
use Closure;

class CanListTransactionStatusDetail
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
        if (!\Auth::user()->ability('sadmin','transaction-status-detail-list')) {
            throw new ForbiddenException();
        }

        return $next($request);
    }
}
