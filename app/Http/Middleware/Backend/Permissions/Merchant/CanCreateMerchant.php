<?php
/**
 * Created by PhpStorm.
 * User: Ladmin
 * Date: 01.11.2019
 * Time: 13:37
 */

namespace App\Http\Middleware\Backend\Permissions\Merchant;


use App\Exceptions\Backend\Web\ForbiddenException;
use Closure;

class CanCreateMerchant
{
    public function handle($request, Closure $next)
    {
        if (!\Auth::user()->ability('sadmin', 'merchant-create')) {
            throw new ForbiddenException();
        }

        return $next($request);
    }
}