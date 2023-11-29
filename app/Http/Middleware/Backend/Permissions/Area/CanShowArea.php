<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 12.03.2019
 * Time: 9:26
 */

namespace App\Http\Middleware\Backend\Permissions\Area;
use App\Exceptions\Backend\Web\ForbiddenException;
use Closure;

class CanShowArea
{
    public function handle($request, Closure $next)
    {
        if (!\Auth::user()->ability('sadmin','area-show')) {
            throw new ForbiddenException();
        }

        return $next($request);
    }
}