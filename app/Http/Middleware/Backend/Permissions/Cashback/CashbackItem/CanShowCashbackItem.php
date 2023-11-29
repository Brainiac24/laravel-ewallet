<?php
/**
 * Created by PhpStorm.
 * User: Ladmin
 * Date: 25.12.2019
 * Time: 13:39
 */

namespace App\Http\Middleware\Backend\Permissions\Cashback\CashbackItem;


use App\Exceptions\Backend\Web\ForbiddenException;
use Closure;

class CanShowCashbackItem
{
    public function handle($request, Closure $next)
    {
        if (!\Auth::user()->ability('sadmin', 'cashback-item-show')) {
            throw new ForbiddenException();
        }

        return $next($request);
    }
}