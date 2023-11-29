<?php
/**
 * Created by PhpStorm.
 * User: Ladmin
 * Date: 21.08.2019
 * Time: 12:00
 */

namespace App\Http\Middleware\Backend\Permissions\Order\OrderType;


use App\Exceptions\Backend\Web\ForbiddenException;
use Closure;

class CanListOrderType
{
    public function handle($request, Closure $next)
    {
        if (!\Auth::user()->ability('sadmin', 'order-orderType-list')) {
            throw new ForbiddenException();
        }

        return $next($request);
    }
}