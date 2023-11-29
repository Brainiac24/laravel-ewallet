<?php


namespace App\Http\Middleware\Backend\Permissions\Cashback\BonusAccrual;


use App\Exceptions\Backend\Web\ForbiddenException;
use Closure;

class CanListBonusAccrual
{
    public function handle($request, Closure $next)
    {
        if (!\Auth::user()->ability('sadmin', 'bonus-accrual-list')) {
            throw new ForbiddenException();
        }

        return $next($request);
    }
}