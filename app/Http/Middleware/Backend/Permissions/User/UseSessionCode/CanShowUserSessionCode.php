<?php
/**
 * Created by PhpStorm.
 * User: Ladmin
 * Date: 02.09.2019
 * Time: 11:53
 */

namespace App\Http\Middleware\Backend\Permissions\User\UseSessionCode;


use App\Exceptions\Backend\Web\ForbiddenException;
use Closure;

class CanShowUserSessionCode
{
    public function handle($request, Closure $next)
    {
        if (!\Auth::user()->ability('sadmin', 'user-userSessionCode-show')) {
            throw new ForbiddenException();
        }

        return $next($request);
    }
}