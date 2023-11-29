<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 22.07.2019
 * Time: 10:45
 */

namespace App\Http\Middleware\Backend\Permissions\Order\OrderDepositType;


use Closure;
use Illuminate\Support\Facades\Auth;
use App\Exceptions\Backend\Web\ForbiddenException;

class CanEditOrderDepositType
{
    public function handle($request, Closure $next)
    {
        if (!\Auth::user()->ability('sadmin', 'order-deposit-type-edit')) {
            throw new ForbiddenException();
        }

        return $next($request);
    }
}