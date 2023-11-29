<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 12.03.2019
 * Time: 9:23
 */

namespace App\Http\Middleware\Backend\Permissions\Area;
use App\Exceptions\Backend\Web\ForbiddenException;
use Closure;

class CanListArea
{
    /**
     * @param $request
     * @param Closure $next
     * @return mixed
     * @throws ForbiddenException
     */
    public function handle($request, Closure $next)
    {
        if (!\Auth::user()->ability('sadmin','area-list')) {
            throw new ForbiddenException();
        }

        return $next($request);
    }
}