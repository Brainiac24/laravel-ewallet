<?php
/**
 * Created by PhpStorm.
 * User: Ladmin
 * Date: 11.12.2019
 * Time: 14:10
 */

namespace App\Http\Middleware\Backend\Permissions\User\Client;


use App\Exceptions\Backend\Web\ForbiddenException;
use Closure;

class CanResetPasswordClient
{
    public function handle($request, Closure $next)
    {
        if (!\Auth::user()->ability(null, 'client-resetPassword')) {
            throw new ForbiddenException();
        }

        return $next($request);
    }
}