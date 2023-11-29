<?php


namespace App\Http\Middleware\Backend\Permissions\CoordinatePoint\CoordinatePointWorkday;


use App\Exceptions\Backend\Web\ForbiddenException;
use Closure;

class CanEditCoordinatePointWorkday
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
        if (!\Auth::user()->ability('sadmin','coordinates-point-workday-edit')) {
            throw new ForbiddenException();
        }

        return $next($request);
    }
}