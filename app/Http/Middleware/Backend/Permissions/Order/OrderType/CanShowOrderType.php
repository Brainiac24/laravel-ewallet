<?php
/**
 * Created by PhpStorm.
 * User: Ladmin
 * Date: 21.08.2019
 * Time: 12:01
 */

namespace App\Http\Middleware\Backend\Permissions\Order\OrderType;


use App\Exceptions\Backend\Web\ForbiddenException;
use Closure;

class CanShowOrderType
{
    public function handle($request, Closure $next)
    {
        if (!\Auth::user()->ability('sadmin', 'order-orderType-show')) {
            throw new ForbiddenException();
        }

        return $next($request);
    }
}