<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 12.03.2019
 * Time: 10:14
 */

namespace App\Http\Middleware\Backend\Permissions\City;
use App\Exceptions\Backend\Web\ForbiddenException;
use Closure;

class CanCreateCity
{
    /**
     * @param $request
     * @param Closure $next
     * @return mixed
     * @throws ForbiddenException
     */
    public function handle($request, Closure $next)
    {
        if (!\Auth::user()->ability('sadmin','city-create')) {
            throw new ForbiddenException();
        }

        return $next($request);
    }
}