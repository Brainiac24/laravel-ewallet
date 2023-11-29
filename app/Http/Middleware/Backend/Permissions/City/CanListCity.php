<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 12.03.2019
 * Time: 10:12
 */

namespace App\Http\Middleware\Backend\Permissions\City;
use App\Exceptions\Backend\Web\ForbiddenException;
use Closure;

class CanListCity
{
    /**
     * @param $request
     * @param Closure $next
     * @return mixed
     * @throws ForbiddenException
     */
    public function handle($request, Closure $next)
    {
        if (!\Auth::user()->ability('sadmin','city-list')) {
            throw new ForbiddenException();
        }

        return $next($request);
    }
}