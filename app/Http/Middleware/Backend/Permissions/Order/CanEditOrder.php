<?php
/**
 * Created by PhpStorm.
 * User: Ladmin
 * Date: 23.01.2020
 * Time: 17:42
 */

namespace App\Http\Middleware\Backend\Permissions\Order;


use App\Exceptions\Backend\Web\ForbiddenException;
use Closure;

class CanEditOrder
{
    public function handle($request, Closure $next)
    {
        if (!\Auth::user()->ability('sadmin', 'order-edit')) {
            throw new ForbiddenException();
        }

        return $next($request);
    }
}