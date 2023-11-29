<?php

namespace App\Http\Middleware\Backend\Permissions\Job\JobHistory;


use App\Exceptions\Backend\Web\ForbiddenException;
use Closure;

class CanShowJobHistory
{
    public function handle($request, Closure $next)
    {
        if (!\Auth::user()->ability('sadmin', 'jobHistory-show') ||
            !\Auth::user()->ability('sadmin', ['jobHistory-can-all','jobHistory-can-by-user'])) {
            throw new ForbiddenException();
        }

        return $next($request);
    }
}