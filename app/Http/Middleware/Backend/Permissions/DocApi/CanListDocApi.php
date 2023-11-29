<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 11.03.2019
 * Time: 17:07
 */

namespace App\Http\Middleware\Backend\Permissions\DocApi;


use App\Exceptions\Backend\Web\ForbiddenException;
use Closure;

class CanListDocApi
{
    public function handle($request, Closure $next)
    {
        if (!\Auth::user()->ability('sadmin', 'docapi-list')) {
            throw new ForbiddenException();
        }

        return $next($request);
    }
}