<?php


namespace App\Http\Middleware\Backend\Permissions\Transaction\TransactionContinueRule;


use App\Exceptions\Backend\Web\ForbiddenException;
use Closure;

class CanDeleteTransactionContinueRule
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     * @throws ForbiddenException
     */
    public function handle($request, Closure $next)
    {
        if (!\Auth::user()->ability('sadmin', 'transaction-continue-rule-delete')) {
            throw new ForbiddenException();
        }

        return $next($request);

    }
}