<?php


namespace App\Http\Middleware\Backend\Permissions\Schedule\ScheduleJob;


use App\Exceptions\Backend\Web\ForbiddenException;
use Closure;

class CanShowScheduleJob
{
    public function handle($request, Closure $next)
    {
        if (!\Auth::user()->ability('sadmin','schedule-job-show')) {
            throw new ForbiddenException();
        }

        return $next($request);
    }
}