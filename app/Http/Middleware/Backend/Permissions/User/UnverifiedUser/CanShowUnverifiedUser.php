<?php
/**
 * Created by PhpStorm.
 * User: Ladmin
 * Date: 30.08.2019
 * Time: 14:23
 */

namespace App\Http\Middleware\Backend\Permissions\User\UnverifiedUser;


use App\Exceptions\Backend\Web\ForbiddenException;
use Closure;

class CanShowUnverifiedUser
{
    public function handle($request, Closure $next)
    {
        if (!\Auth::user()->ability('sadmin', 'user-unverifiedUser-show')) {
            throw new ForbiddenException();
        }

        return $next($request);
    }
}