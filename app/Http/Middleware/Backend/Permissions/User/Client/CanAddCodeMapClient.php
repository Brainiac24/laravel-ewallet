<?php
/**
 * Created by PhpStorm.
 * User: Ladmin
 * Date: 20.08.2019
 * Time: 9:54
 */

namespace App\Http\Middleware\Backend\Permissions\User\Client;


use App\Exceptions\Backend\Web\ForbiddenException;
use Closure;

class CanAddCodeMapClient
{
    public function handle($request, Closure $next)
    {
        if (!\Auth::user()->ability(null, 'client-addCodeMap')) {
            throw new ForbiddenException();
        }

        return $next($request);
    }
}