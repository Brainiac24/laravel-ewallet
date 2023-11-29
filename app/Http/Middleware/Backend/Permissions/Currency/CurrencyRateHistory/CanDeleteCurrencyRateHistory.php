<?php

namespace App\Http\Middleware\Backend\Permissions\Currency\CurrencyRateHistory;

use App\Exceptions\Backend\Web\ForbiddenException;
use Closure;

class CanDeleteCurrencyRateHistory
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
        if (!\Auth::user()->ability('sadmin','currency-rate-hist-delete')) {
            throw new ForbiddenException();
        }

        return $next($request);
    }
}
