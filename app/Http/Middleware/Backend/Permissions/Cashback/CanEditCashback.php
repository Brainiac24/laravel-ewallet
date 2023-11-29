<?php
/**
 * Created by PhpStorm.
 * User: Ladmin
 * Date: 19.12.2019
 * Time: 16:37
 */

namespace App\Http\Middleware\Backend\Permissions\Cashback;


use App\Exceptions\Backend\Web\ForbiddenException;
use Closure;

class CanEditCashback
{
    public function handle($request, Closure $next)
    {
        if (!\Auth::user()->ability('sadmin', 'cashback-edit')) {
            throw new ForbiddenException();
        }

        return $next($request);
    }
}