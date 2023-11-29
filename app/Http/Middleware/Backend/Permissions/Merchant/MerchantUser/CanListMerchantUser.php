<?php


namespace App\Http\Middleware\Backend\Permissions\Merchant\MerchantUser;


use App\Exceptions\Backend\Web\ForbiddenException;
use Closure;

class CanListMerchantUser
{
    public function handle($request, Closure $next)
    {
        if (!\Auth::user()->ability('sadmin', 'merchant-user-list')) {
            throw new ForbiddenException();
        }

        return $next($request);
    }
}