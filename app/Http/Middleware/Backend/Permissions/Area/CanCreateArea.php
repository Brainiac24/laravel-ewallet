<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 12.03.2019
 * Time: 9:27
 */

namespace App\Http\Middleware\Backend\Permissions\Area;
use App\Exceptions\Backend\Web\ForbiddenException;
use Closure;

class CanCreateArea
{
    public function handle($request, Closure $next)
    {
        if (!\Auth::user()->ability('sadmin','area-create')) {
            throw new ForbiddenException();
        }

        return $next($request);
    }
}