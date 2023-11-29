<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 12.03.2019
 * Time: 8:58
 */

namespace App\Http\Middleware\Backend\Permissions\Region;
use App\Exceptions\Backend\Web\ForbiddenException;
use Closure;

class CanListRegion
{

    /**
     * @param $request
     * @param Closure $next
     * @return mixed
     * @throws ForbiddenException
     */
    public function handle($request, Closure $next)
    {
        if (!\Auth::user()->ability('sadmin','region-list')) {
            throw new ForbiddenException();
        }

        return $next($request);
    }
}