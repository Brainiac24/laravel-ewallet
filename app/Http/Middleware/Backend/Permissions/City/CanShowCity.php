<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 12.03.2019
 * Time: 10:13
 */

namespace App\Http\Middleware\Backend\Permissions\City;
use App\Exceptions\Backend\Web\ForbiddenException;
use Closure;

class CanShowCity
{
    /**
     * @param $request
     * @param Closure $next
     * @return mixed
     * @throws ForbiddenException
     */
    public function handle($request, Closure $next)
    {
        if (!\Auth::user()->ability('sadmin','city-show')) {
            throw new ForbiddenException();
        }

        return $next($request);
    }
}