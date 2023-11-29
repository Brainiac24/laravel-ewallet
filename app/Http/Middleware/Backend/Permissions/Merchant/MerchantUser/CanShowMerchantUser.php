<?php


namespace App\Http\Middleware\Backend\Permissions\Merchant\MerchantUser;


use App\Exceptions\Backend\Web\ForbiddenException;
use Closure;

class CanShowMerchantUser
{
    public function handle($request, Closure $next)
    {
        if (!\Auth::user()->ability('sadmin', 'merchant-user-show')) {
            throw new ForbiddenException();
        }

        return $next($request);
    }
}