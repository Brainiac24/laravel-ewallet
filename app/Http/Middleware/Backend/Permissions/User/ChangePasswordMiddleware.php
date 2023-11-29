<?php

namespace App\Http\Middleware\Backend\Permissions\User;

use Closure;
use Carbon\Carbon;

class ChangePasswordMiddleware
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
        $passwordParams = \Auth::user()->password_params_json;

        if (isset($passwordParams["is_change_password"]) && isset($passwordParams["last_changed_password"]) &&
            $passwordParams["is_change_password"] == false &&
            Carbon::createFromTimeString($passwordParams["last_changed_password"])->diffInDays() < config("auth.password_expire_day")) {
            return $next($request);
        }

        return redirect()->route("admin.changePassword");
    }
}
