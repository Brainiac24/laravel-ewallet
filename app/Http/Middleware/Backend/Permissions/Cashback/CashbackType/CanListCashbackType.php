<?php


namespace App\Http\Middleware\Backend\Permissions\Cashback\CashbackType;


use App\Exceptions\Backend\Web\ForbiddenException;
use Closure;

class CanListCashbackType
{
    public function handle($request, Closure $next)
    {
        if (!\Auth::user()->ability('sadmin', 'cachback-type-list')) {
            throw new ForbiddenException();
        }

        return $next($request);
    }
}