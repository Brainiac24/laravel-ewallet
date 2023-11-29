<?php
/**
 * Created by PhpStorm.
 * User: Ladmin
 * Date: 22.10.2019
 * Time: 10:15
 */

namespace App\Http\Middleware\Backend\Permissions\User\Client;


use App\Exceptions\Backend\Web\ForbiddenException;
use Closure;

class CanDeleteCodeMapClient
{
    public function handle($request, Closure $next)
    {
        if (!\Auth::user()->ability(null, 'client-deleteCodeMap')) {
            throw new ForbiddenException();
        }

        return $next($request);
    }
}