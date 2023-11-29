<?php
/**
 * Created by PhpStorm.
 * User: Ladmin
 * Date: 24.02.2020
 * Time: 14:14
 */

namespace App\Http\Middleware\Backend\Permissions\Merchant\MerchantCommission;


use App\Exceptions\Backend\Web\ForbiddenException;
use Closure;

class CanShowMerchantCommission
{
    public function handle($request, Closure $next)
    {
        if (!\Auth::user()->ability('sadmin', 'merchant-commission-show')) {
            throw new ForbiddenException();
        }

        return $next($request);
    }
}