<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 12.03.2019
 * Time: 8:59
 */

namespace App\Http\Middleware\Backend\Permissions\Region;
use App\Exceptions\Backend\Web\ForbiddenException;
use Closure;

class CanShowRegion
{
    public function handle($request, Closure $next)
    {
        if (!\Auth::user()->ability('sadmin','region-show')) {
            throw new ForbiddenException();
        }

        return $next($request);
    }
}