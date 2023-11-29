<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 18.03.2019
 * Time: 13:20
 */

namespace App\Http\Middleware\Backend\Permissions\RegisterWithdrawMerchant;


use App\Exceptions\Backend\Web\ForbiddenException;
use Closure;

class CanManageRegistryWithdrawMerhcant
{
    /**
     * @param $request
     * @param Closure $next
     * @return mixed
     * @throws ForbiddenException
     */
    public function handle($request, Closure $next)
    {
        if (!\Auth::user()->ability('sadmin', 'registries-withdraw-merchant')) {
            throw new ForbiddenException();
        }

        return $next($request);
    }
}