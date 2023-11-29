<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 12.03.2019
 * Time: 9:00
 */

namespace App\Http\Middleware\Backend\Permissions\Region;
use App\Exceptions\Backend\Web\ForbiddenException;
use Closure;

class CanCreateRegion
{
    public function handle($request, Closure $next)
    {
        if (!\Auth::user()->ability('sadmin','region-create')) {
            throw new ForbiddenException();
        }

        return $next($request);
    }
}