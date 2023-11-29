<?php


namespace App\Http\Middleware\Backend\Permissions\Merchant\MerchantUser;


use App\Exceptions\Backend\Web\ForbiddenException;
use Closure;

class CanDeleteMerchantUser
{
    public function handle($request, Closure $next)
    {
        if (!\Auth::user()->ability('sadmin', 'merchant-user-delete')) {
            throw new ForbiddenException();
        }

        return $next($request);
    }
}