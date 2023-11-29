<?php
/**
 * Created by PhpStorm.
 * User: Ladmin
 * Date: 17.12.2019
 * Time: 16:32
 */

namespace App\Http\Middleware\Backend\Permissions\Merchant\MerchantWorkdays;


use App\Exceptions\Backend\Web\ForbiddenException;
use Closure;

class CanShowMerchantWorkdays
{
    public function handle($request, Closure $next)
    {
        if (!\Auth::user()->ability('sadmin', 'merchant-workdays-show')) {
            throw new ForbiddenException();
        }

        return $next($request);
    }
}