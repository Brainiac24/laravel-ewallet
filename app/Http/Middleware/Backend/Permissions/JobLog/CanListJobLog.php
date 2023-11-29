<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 15.07.2019
 * Time: 13:39
 */

namespace App\Http\Middleware\Backend\Permissions\JobLog;


use App\Exceptions\Backend\Web\ForbiddenException;
use Closure;

class CanListJobLog
{
    public function handle($request, Closure $next)
    {
        if (!\Auth::user()->ability('sadmin', 'jobLog-list')) {
            throw new ForbiddenException();
        }

        return $next($request);
    }
}