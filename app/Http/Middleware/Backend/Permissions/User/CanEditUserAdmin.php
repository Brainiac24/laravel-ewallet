<?php

namespace App\Http\Middleware\Backend\Permissions\User;

use App\Exceptions\Backend\Web\ForbiddenException;
use Closure;

class CanEditUserAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @throws ForbiddenException
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //dd($request->route()->user);
        if (!\Auth::user()->ability('sadmin','user-edit-admin') && $request->route()->user == config('app_settings.admin_id')) {
            throw new ForbiddenException();
        }

        return $next($request);
    }
}
