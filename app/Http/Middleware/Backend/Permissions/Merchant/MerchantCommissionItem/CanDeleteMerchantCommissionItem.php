<?php
/**
 * Created by PhpStorm.
 * User: Ladmin
 * Date: 24.02.2020
 * Time: 14:17
 */

namespace App\Http\Middleware\Backend\Permissions\Merchant\MerchantCommissionItem;


use App\Exceptions\Backend\Web\ForbiddenException;
use Closure;

class CanDeleteMerchantCommissionItem
{
    public function handle($request, Closure $next)
    {
        if (!\Auth::user()->ability('sadmin', 'merchant-commission-item-delete')) {
            throw new ForbiddenException();
        }

        return $next($request);
    }
}