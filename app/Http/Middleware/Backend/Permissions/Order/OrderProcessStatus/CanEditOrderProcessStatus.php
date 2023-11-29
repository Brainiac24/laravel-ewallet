<?php
/**
 * Created by PhpStorm.
 * User: Ladmin
 * Date: 23.01.2020
 * Time: 17:35
 */

namespace App\Http\Middleware\Backend\Permissions\Order\OrderProcessStatus;


use App\Exceptions\Backend\Web\ForbiddenException;
use Closure;

class CanEditOrderProcessStatus
{
//    public function handle($request, Closure $next)
//    {
//        if (!\Auth::user()->ability(null, 'order-orderProcessStatus-edit')) {
//            throw new ForbiddenException();
//        }
//
//        return $next($request);
//    }
}