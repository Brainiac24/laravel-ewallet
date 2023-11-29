<?php

namespace App\Http\Middleware\Backend\Permissions\User\History;

use App\Exceptions\Backend\Web\ForbiddenException;
use Closure;

class CanListUserHistory
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
        if (!\Auth::user()->ability('sadmin','user-history-list')) {
            throw new ForbiddenException();
        }

        return $next($request);
    }
}
