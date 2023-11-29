<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 22.07.2019
 * Time: 10:46
 */

namespace App\Http\Middleware\Backend\Permissions\Order\OrderCardContractType;


use Closure;
use Illuminate\Support\Facades\Auth;
use App\Exceptions\Backend\Web\ForbiddenException;

class CanShowOrderCardContractType
{
    public function handle($request, Closure $next)
    {
        if (!\Auth::user()->ability('sadmin', 'order-card-contract-type-show')) {
            throw new ForbiddenException();
        }

        return $next($request);
    }
}