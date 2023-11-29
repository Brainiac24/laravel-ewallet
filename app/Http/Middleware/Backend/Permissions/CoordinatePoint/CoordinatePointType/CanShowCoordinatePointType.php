<?php


namespace App\Http\Middleware\Backend\Permissions\CoordinatePoint\CoordinatePointType;


use App\Exceptions\Backend\Web\ForbiddenException;
use Closure;

class CanShowCoordinatePointType
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
        if (!\Auth::user()->ability('sadmin','coordinates-point-type-show')) {
            throw new ForbiddenException();
        }

        return $next($request);
    }
}