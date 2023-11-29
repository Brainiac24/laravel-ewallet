<?php
/**
 * Created by PhpStorm.
 * User: Ladmin
 * Date: 30.08.2019
 * Time: 14:21
 */

namespace App\Http\Middleware\Backend\Permissions\User\UnverifiedUser;


use App\Exceptions\Backend\Web\ForbiddenException;
use Closure;

class CanListUnverifiedUser
{
    public function handle($request, Closure $next)
    {
        if (!\Auth::user()->ability('sadmin', 'user-unverifiedUser-list')) {
            throw new ForbiddenException();
        }

        return $next($request);
    }
}