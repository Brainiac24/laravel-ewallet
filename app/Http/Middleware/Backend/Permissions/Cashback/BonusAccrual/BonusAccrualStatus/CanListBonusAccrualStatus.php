<?php


namespace App\Http\Middleware\Backend\Permissions\Cashback\BonusAccrual\BonusAccrualStatus;


use App\Exceptions\Backend\Web\ForbiddenException;
use Closure;

class CanListBonusAccrualStatus
{
    public function handle($request, Closure $next)
    {
        if (!\Auth::user()->ability('sadmin', 'bonus-accrual-status-list')) {
            throw new ForbiddenException();
        }

        return $next($request);
    }
}