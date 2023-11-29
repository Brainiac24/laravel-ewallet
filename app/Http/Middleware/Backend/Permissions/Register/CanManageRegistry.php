<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 18.03.2019
 * Time: 13:20
 */

namespace App\Http\Middleware\Backend\Permissions\Register;


use App\Exceptions\Backend\Web\ForbiddenException;
use Closure;

class CanManageRegistry
{
    /**
     * @param $request
     * @param Closure $next
     * @return mixed
     * @throws ForbiddenException
     */
    public function handle($request, Closure $next)
    {
        if (!\Auth::user()->ability('sadmin', 'registries')) {
            throw new ForbiddenException();
        }

        return $next($request);
    }
}