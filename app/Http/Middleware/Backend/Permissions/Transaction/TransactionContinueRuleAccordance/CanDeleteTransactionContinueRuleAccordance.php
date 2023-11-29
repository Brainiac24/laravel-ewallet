<?php


namespace App\Http\Middleware\Backend\Permissions\Transaction\TransactionContinueRuleAccordance;


use App\Exceptions\Backend\Web\ForbiddenException;
use Closure;

class CanDeleteTransactionContinueRuleAccordance
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
        if (!\Auth::user()->ability('sadmin', 'transaction-continue-rule-accordance-delete')) {
            throw new ForbiddenException();
        }

        return $next($request);

    }
}