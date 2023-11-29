<?php


namespace App\Http\Middleware\Backend\Permissions\CoordinatePoint\CoordinatePointCity;


use App\Exceptions\Backend\Web\ForbiddenException;
use Closure;

class CanEditCoordinatePointCity
{
    public function handle($request, Closure $next)
    {
        if (!\Auth::user()->ability('sadmin','coordinates-point-city-edit')) {
            throw new ForbiddenException();
        }

        return $next($request);
    }
}