<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 22.07.2019
 * Time: 10:43
 */

namespace App\Http\Middleware\Backend\Permissions\Order\OrderDepositType;


use Closure;
use Illuminate\Support\Facades\Auth;
use App\Exceptions\Backend\Web\ForbiddenException;

class CanDeleteOrderDepositType
{
    public function handle($request, Closure $next)
    {
        if (!\Auth::user()->ability('sadmin', 'order-deposit-type-delete')) {
            throw new ForbiddenException();
        }

        return $next($request);
    }
}