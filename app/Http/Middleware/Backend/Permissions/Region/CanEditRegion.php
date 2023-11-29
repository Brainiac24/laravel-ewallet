<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 12.03.2019
 * Time: 9:01
 */

namespace App\Http\Middleware\Backend\Permissions\Region;
use Closure;

class CanEditRegion
{
    public function handle($request, Closure $next)
    {
        if (!\Auth::user()->ability('sadmin','region-edit')) {
            throw new ForbiddenException();
        }

        return $next($request);
    }
}