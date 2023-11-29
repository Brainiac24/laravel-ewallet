<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 22.07.2019
 * Time: 10:43
 */

namespace App\Http\Middleware\Backend\Permissions\Order\OrderCardType;


use Closure;
use App\Exceptions\Backend\Web\ForbiddenException;

class CanDeleteOrderCardType
{
    public function handle($request, Closure $next)
    {
        if (!\Auth::user()->ability('sadmin', 'order-card-type-delete')) {
            throw new ForbiddenException();
        }

        return $next($request);
    }
}