<?php
/**
 * Created by PhpStorm.
 * User: Ladmin
 * Date: 21.08.2019
 * Time: 11:59
 */

namespace App\Http\Middleware\Backend\Permissions\Order\OrderStatus;


use App\Exceptions\Backend\Web\ForbiddenException;
use Closure;

class CanListOrderStatus
{
    public function handle($request, Closure $next)
    {
        if (!\Auth::user()->ability('sadmin', 'order-orderStatus-list')) {
            throw new ForbiddenException();
        }

        return $next($request);
    }
}