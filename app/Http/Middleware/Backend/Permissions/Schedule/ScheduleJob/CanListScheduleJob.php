<?php


namespace App\Http\Middleware\Backend\Permissions\Schedule\ScheduleJob;


use App\Exceptions\Backend\Web\ForbiddenException;
use Closure;

class CanListScheduleJob
{
    public function handle($request, Closure $next)
    {
        if (!\Auth::user()->ability('sadmin','schedule-job-list')) {
            throw new ForbiddenException();
        }

        return $next($request);
    }
}