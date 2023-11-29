<?php
/**
 * Created by PhpStorm.
 * User: Ladmin
 * Date: 22.08.2019
 * Time: 18:45
 */

namespace App\Http\Middleware\Backend\Permissions\User\TempUser;


use App\Exceptions\Backend\Web\ForbiddenException;
use Closure;

class CanShowTempUser
{
    public function handle($request, Closure $next)
    {
        if (!\Auth::user()->ability('sadmin', 'user-tempUser-show')) {
            throw new ForbiddenException();
        }

        return $next($request);
    }
}