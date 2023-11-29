<?php
namespace App\Http\Middleware\Backend\Permissions\Order\RemoteIdentification;


use Closure;
use Illuminate\Support\Facades\Auth;
use App\Exceptions\Backend\Web\ForbiddenException;

class CanShowRemoteIdentification
{
    public function handle($request, Closure $next)
    {
        if (!Auth::user()->ability('sadmin', 'remote-identification-show')) {
            throw new ForbiddenException();
        }

        return $next($request);
    }
}