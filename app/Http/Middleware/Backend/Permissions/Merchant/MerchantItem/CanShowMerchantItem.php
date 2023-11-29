<?php
/**
 * Created by PhpStorm.
 * User: Ladmin
 * Date: 05.11.2019
 * Time: 10:42
 */

namespace App\Http\Middleware\Backend\Permissions\Merchant\MerchantItem;


use App\Exceptions\Backend\Web\ForbiddenException;
use Closure;

class CanShowMerchantItem
{
    public function handle($request, Closure $next)
    {
        if (!\Auth::user()->ability('sadmin', 'merchant-item-show')) {
            throw new ForbiddenException();
        }

        return $next($request);
    }
}