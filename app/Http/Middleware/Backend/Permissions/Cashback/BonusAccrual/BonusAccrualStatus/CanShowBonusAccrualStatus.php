<?php


namespace App\Http\Middleware\Backend\Permissions\Cashback\BonusAccrual\BonusAccrualStatus;


use App\Exceptions\Backend\Web\ForbiddenException;
use Closure;

class CanShowBonusAccrualStatus
{
    public function handle($request, Closure $next)
    {
        if (!\Auth::user()->ability('sadmin', 'bonus-accrual-status-show')) {
            throw new ForbiddenException();
        }

        return $next($request);
    }
}