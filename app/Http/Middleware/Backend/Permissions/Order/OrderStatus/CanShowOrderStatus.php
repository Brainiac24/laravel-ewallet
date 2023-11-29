<?php
/**
 * Created by PhpStorm.
 * User: Ladmin
 * Date: 21.08.2019
 * Time: 12:00
 */

namespace App\Http\Middleware\Backend\Permissions\Order\OrderStatus;


use App\Exceptions\Backend\Web\ForbiddenException;
use Closure;

class CanShowOrderStatus
{
    public function handle($request, Closure $next)
    {
        if (!\Auth::user()->ability('sadmin', 'order-orderStatus-show')) {
            throw new ForbiddenException();
        }

        return $next($request);
    }
}