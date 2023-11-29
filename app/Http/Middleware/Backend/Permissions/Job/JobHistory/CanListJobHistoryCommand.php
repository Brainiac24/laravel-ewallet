<?php


namespace App\Http\Middleware\Backend\Permissions\Job\JobHistory;


use App\Exceptions\Backend\Web\ForbiddenException;
use Closure;

class CanListJobHistoryCommand
{
    public function handle($request, Closure $next)
    {
        if (!\Auth::user()->ability('sadmin', 'jobHistoryCommand-list')) {
            throw new ForbiddenException();
        }

        return $next($request);
    }
}