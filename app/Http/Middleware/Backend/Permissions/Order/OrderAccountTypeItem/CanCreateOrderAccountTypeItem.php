<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 22.07.2019
 * Time: 10:42
 */

namespace App\Http\Middleware\Backend\Permissions\Order\OrderAccountTypeItem;


use Closure;
use Illuminate\Support\Facades\Auth;
use App\Exceptions\Backend\Web\ForbiddenException;

class CanCreateOrderAccountTypeItem
{
    public function handle($request, Closure $next)
    {
        if (!\Auth::user()->ability('sadmin', 'order-account-type-item-create')) {
            throw new ForbiddenException();
        }

        return $next($request);
    }
}