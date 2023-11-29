<?php

namespace App\Http\Middleware\Backend\Permissions\User\Favorite;

use App\Exceptions\Backend\Web\ForbiddenException;
use Closure;

class CanEditUserFavorite
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @throws ForbiddenException
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!\Auth::user()->ability('sadmin','user-favorite-edit')) {
            throw new ForbiddenException();
        }

        return $next($request);
    }
}
