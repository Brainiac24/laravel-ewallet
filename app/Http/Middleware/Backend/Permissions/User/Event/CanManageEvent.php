<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 01.08.2019
 * Time: 11:52
 */

namespace App\Http\Middleware\Backend\Permissions\User\Event;


use App\Exceptions\Backend\Web\ForbiddenException;
use Closure;

class CanManageEvent
{
    public function handle($request, Closure $next)
    {
        if (!\Auth::user()->ability('sadmin','events')) {
            throw new ForbiddenException();
        }

        return $next($request);
    }
}