<?php
/**
 * Created by PhpStorm.
 * User: Ladmin
 * Date: 17.12.2019
 * Time: 14:05
 */

namespace App\Http\Middleware\Backend\Permissions\Merchant\MerchantCategory;


use App\Exceptions\Backend\Web\ForbiddenException;
use Closure;

class CanCreateMerchantCategory
{
    public function handle($request, Closure $next)
    {
        if (!\Auth::user()->ability('sadmin', 'merchant-category-create')) {
            throw new ForbiddenException();
        }

        return $next($request);
    }
}