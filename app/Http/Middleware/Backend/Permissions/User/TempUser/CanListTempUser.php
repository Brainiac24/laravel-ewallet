<?php
/**
 * Created by PhpStorm.
 * User: Ladmin
 * Date: 22.08.2019
 * Time: 18:39
 */

namespace App\Http\Middleware\Backend\Permissions\User\TempUser;


use App\Exceptions\Backend\Web\ForbiddenException;
use Closure;

class CanListTempUser
{
    public function handle($request, Closure $next)
    {
        if (!\Auth::user()->ability('sadmin', 'user-tempUser-list')) {
            throw new ForbiddenException();
        }

        return $next($request);
    }
}