<?php


namespace App\Http\Middleware\Backend\Permissions\Cashback\CashbackType;


use App\Exceptions\Backend\Web\ForbiddenException;
use Closure;

class CanCreateCashbackType
{
    public function handle($request, Closure $next)
    {
        if (!\Auth::user()->ability('sadmin', 'cachback-type-create')) {
            throw new ForbiddenException();
        }

        return $next($request);
    }
}