<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 22.07.2019
 * Time: 10:42
 */

namespace App\Http\Middleware\Backend\Permissions\Order\OrderCardContractType;


use Closure;
use App\Exceptions\Backend\Web\ForbiddenException;

class CanCreateOrderCardContractType
{
    public function handle($request, Closure $next)
    {
        if (!\Auth::user()->ability('sadmin', 'order-card-contract-type-create')) {
            throw new ForbiddenException();
        }

        return $next($request);
    }
}