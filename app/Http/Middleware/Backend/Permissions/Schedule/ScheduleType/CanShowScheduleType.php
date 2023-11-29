<?php


namespace App\Http\Middleware\Backend\Permissions\Schedule\ScheduleType;


use App\Exceptions\Backend\Web\ForbiddenException;
use Closure;

class CanShowScheduleType
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @throws ForbiddenException
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!\Auth::user()->ability('sadmin','schedule-type-show')) {
            throw new ForbiddenException();
        }

        return $next($request);
    }
}