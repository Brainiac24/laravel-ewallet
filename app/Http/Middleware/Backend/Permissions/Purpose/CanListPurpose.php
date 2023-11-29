<?php
/**
 * Created by PhpStorm.
 * User: Ladmin
 * Date: 23.08.2019
 * Time: 10:51
 */

namespace App\Http\Middleware\Backend\Permissions\Purpose;


use App\Exceptions\Backend\Web\ForbiddenException;
use Closure;

class CanListPurpose
{
    public function handle($request, Closure $next)
    {
        if (!\Auth::user()->ability('sadmin','purpose-list')) {
            throw new ForbiddenException();
        }

        return $next($request);
    }
}