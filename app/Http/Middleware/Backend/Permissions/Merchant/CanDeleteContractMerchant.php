<?php


namespace App\Http\Middleware\Backend\Permissions\Merchant;


use App\Exceptions\Backend\Web\ForbiddenException;
use Closure;

class CanDeleteContractMerchant
{
    public function handle($request, Closure $next)
    {
        if (!\Auth::user()->ability('sadmin', 'merchant-delete-contract')) {
            throw new ForbiddenException();
        }

        return $next($request);
    }
}