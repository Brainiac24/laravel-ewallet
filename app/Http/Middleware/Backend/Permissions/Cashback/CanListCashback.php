<?php
/**
 * Created by PhpStorm.
 * User: Ladmin
 * Date: 19.12.2019
 * Time: 16:36
 */

namespace App\Http\Middleware\Backend\Permissions\Cashback;


use App\Exceptions\Backend\Web\ForbiddenException;
use Closure;

class CanListCashback
{
    public function handle($request, Closure $next)
    {
        if (!\Auth::user()->ability('sadmin', 'cashback-list')) {
            throw new ForbiddenException();
        }

        return $next($request);
    }
}