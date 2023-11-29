<?php


namespace App\Http\Middleware\Backend\Permissions\Branch;


use App\Exceptions\Backend\Web\ForbiddenException;
use Closure;

class CanCreateBranch
{
    public function handle($request, Closure $next)
    {
        if (!\Auth::user()->ability('sadmin', 'branch-create')) {
            throw new ForbiddenException();
        }

        return $next($request);
    }
}