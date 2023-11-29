<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 11.03.2019
 * Time: 17:09
 */

namespace App\Http\Middleware\Backend\Permissions\Country;


use App\Exceptions\Backend\Web\ForbiddenException;
use Closure;

class CanDeleteCountry
{
    public function handle($request, Closure $next)
    {
        if (!\Auth::user()->ability('sadmin','country-delete')) {
            throw new ForbiddenException();
        }

        return $next($request);
    }
}