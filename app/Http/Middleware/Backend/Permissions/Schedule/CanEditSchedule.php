<?php


namespace App\Http\Middleware\Backend\Permissions\Schedule;


use App\Exceptions\Backend\Web\ForbiddenException;
use Closure;

class CanEditSchedule
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
        if (!\Auth::user()->ability('sadmin','schedule-edit')) {
            throw new ForbiddenException();
        }

        return $next($request);
    }
}