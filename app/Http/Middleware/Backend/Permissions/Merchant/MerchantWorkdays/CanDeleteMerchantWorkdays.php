<?php
/**
 * Created by PhpStorm.
 * User: Ladmin
 * Date: 17.12.2019
 * Time: 16:31
 */

namespace App\Http\Middleware\Backend\Permissions\Merchant\MerchantWorkdays;


use App\Exceptions\Backend\Web\ForbiddenException;
use Closure;

class CanDeleteMerchantWorkdays
{
    public function handle($request, Closure $next)
    {
        if (!\Auth::user()->ability('sadmin', 'merchant-workdays-delete')) {
            throw new ForbiddenException();
        }

        return $next($request);
    }
}