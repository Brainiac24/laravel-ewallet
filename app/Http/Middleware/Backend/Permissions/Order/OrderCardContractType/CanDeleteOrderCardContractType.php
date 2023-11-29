<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 22.07.2019
 * Time: 10:43
 */

namespace App\Http\Middleware\Backend\Permissions\Order\OrderCardContractType;


use Closure;
use Illuminate\Support\Facades\Auth;
use App\Exceptions\Backend\Web\ForbiddenException;

class CanDeleteOrderCardContractType
{
    public function handle($request, Closure $next)
    {
        if (!\Auth::user()->ability('sadmin', 'order-card-contract-type-delete')) {
            throw new ForbiddenException();
        }

        return $next($request);
    }
}