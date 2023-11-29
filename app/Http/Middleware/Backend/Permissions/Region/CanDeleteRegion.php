<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 12.03.2019
 * Time: 9:04
 */

namespace App\Http\Middleware\Backend\Permissions\Region;
use App\Exceptions\Backend\Web\ForbiddenException;
use Closure;

class CanDeleteRegion
{
    public function handle($request, Closure $next)
    {
        if (!\Auth::user()->ability('sadmin','region-delete')) {
            throw new ForbiddenException();
        }

        return $next($request);
    }
}