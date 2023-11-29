<?php

namespace App\Http\Middleware\Backend\Permissions\Currency\CurrencyRate;

use App\Exceptions\Backend\Web\ForbiddenException;
use Closure;

class CanCreateCurrencyRate
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
        if (!\Auth::user()->ability('sadmin','currency-rate-create')) {
            throw new ForbiddenException();
        }

        return $next($request);
    }
}
