<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 11.03.2019
 * Time: 17:11
 */

namespace App\Http\Middleware\Backend\Permissions\Country;


use App\Exceptions\Backend\Web\ForbiddenException;
use Closure;

class CanCreateCountry
{
    public function handle($request, Closure $next)
    {
        if (!\Auth::user()->ability('sadmin','country-create')) {
            throw new ForbiddenException();
        }

        return $next($request);
    }
}