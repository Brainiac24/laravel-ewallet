<?php
/**
 * Created by PhpStorm.
 * User: Ladmin
 * Date: 21.08.2019
 * Time: 11:57
 */

namespace App\Http\Middleware\Backend\Permissions\Order;


use App\Exceptions\Backend\Web\ForbiddenException;
use Closure;

class CanListOrder
{
    public function handle($request, Closure $next)
    {
        if (!\Auth::user()->ability('sadmin','order-list')) {
            throw new ForbiddenException();
        }

        return $next($request);
    }
}