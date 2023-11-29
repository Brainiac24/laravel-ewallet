<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 29.07.2019
 * Time: 16:19
 */

namespace App\Http\Middleware\Backend\Permissions\Color;


use App\Exceptions\Backend\Web\ForbiddenException;
use Closure;

class CanManageColor
{
    public function handle($request, Closure $next)
    {
        if (!\Auth::user()->ability('sadmin','colors')) {
            throw new ForbiddenException();
        }

        return $next($request);
    }
}