<?php

namespace App\Http\Middleware\Backend\Permissions\User;

use Closure;

class IsActiveMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (\Auth::user()->is_active == 1 && \Auth::user()->is_admin == 1) {
            return $next($request);
        }

        return redirect()->guest(route('admin.access.login'))->withErrors(trans('users.backend.access_denied'));
    }
}
