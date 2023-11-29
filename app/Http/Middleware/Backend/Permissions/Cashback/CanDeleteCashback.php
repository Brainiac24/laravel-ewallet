<?php
/**
 * Created by PhpStorm.
 * User: Ladmin
 * Date: 19.12.2019
 * Time: 16:38
 */

namespace App\Http\Middleware\Backend\Permissions\Cashback;


use App\Exceptions\Backend\Web\ForbiddenException;
use Closure;

class CanDeleteCashback
{
    public function handle($request, Closure $next)
    {
        if (!\Auth::user()->ability('sadmin', 'cashback-delete')) {
            throw new ForbiddenException();
        }

        return $next($request);
    }
}