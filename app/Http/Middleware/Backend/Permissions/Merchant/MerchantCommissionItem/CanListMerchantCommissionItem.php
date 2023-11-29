<?php
/**
 * Created by PhpStorm.
 * User: Ladmin
 * Date: 24.02.2020
 * Time: 14:18
 */

namespace App\Http\Middleware\Backend\Permissions\Merchant\MerchantCommissionItem;


use App\Exceptions\Backend\Web\ForbiddenException;
use Closure;

class CanListMerchantCommissionItem
{
    public function handle($request, Closure $next)
    {
        if (!\Auth::user()->ability('sadmin', 'merchant-commission-item-list')) {
            throw new ForbiddenException();
        }

        return $next($request);
    }
}