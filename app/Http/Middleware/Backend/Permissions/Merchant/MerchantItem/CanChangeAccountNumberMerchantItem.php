<?php
/**
 * Created by PhpStorm.
 * User: Ladmin
 * Date: 15.11.2019
 * Time: 14:44
 */

namespace App\Http\Middleware\Backend\Permissions\Merchant\MerchantItem;


use App\Exceptions\Backend\Web\ForbiddenException;
use Closure;

class CanChangeAccountNumberMerchantItem
{
    public function handle($request, Closure $next)
    {
        if (!\Auth::user()->ability('sadmin', 'merchant-item-changeAccountNumber')) {
            throw new ForbiddenException();
        }

        return $next($request);
    }
}