<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 15.07.2019
 * Time: 13:56
 */

namespace App\Http\Middleware\Backend\Permissions\JobLog;


use App\Exceptions\Backend\Web\ForbiddenException;
use Closure;

class CanShowJobLog
{
    public function handle($request, Closure $next)
    {
        if (!\Auth::user()->ability('sadmin', 'jobLog-show')) {
            throw new ForbiddenException();
        }

        return $next($request);
    }
}