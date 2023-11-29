<?php


namespace App\Http\Middleware\Backend\Permissions\CoordinatePoint\CoordinatePointService;


use App\Exceptions\Backend\Web\ForbiddenException;
use Closure;

class CanCreateCoordinatePointService
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
        if (!\Auth::user()->ability('sadmin','coordinates-point-service-create')) {
            throw new ForbiddenException();
        }

        return $next($request);
    }
}