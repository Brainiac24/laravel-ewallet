<?php
/**
 * Created by PhpStorm.
 * User: Ladmin
 * Date: 24.02.2020
 * Time: 14:13
 */

namespace App\Http\Middleware\Backend\Permissions\Merchant\MerchantCommission;


use App\Exceptions\Backend\Web\ForbiddenException;
use Closure;

class CanCreateMerchantCommission
{
    public function handle($request, Closure $next)
    {
        if (!\Auth::user()->ability('sadmin', 'merchant-commission-create')) {
            throw new ForbiddenException();
        }

        return $next($request);
    }
}