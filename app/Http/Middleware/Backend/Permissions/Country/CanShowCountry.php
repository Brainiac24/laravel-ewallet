<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 11.03.2019
 * Time: 15:37
 */

namespace App\Http\Middleware\Backend\Permissions\Country;


use App\Exceptions\Backend\Web\ForbiddenException;
use Closure;

class CanShowCountry
{
    public function handle($request, Closure $next)
    {
        if (!\Auth::user()->ability('sadmin','country-show')) {
            throw new ForbiddenException();
        }

        return $next($request);
    }
}