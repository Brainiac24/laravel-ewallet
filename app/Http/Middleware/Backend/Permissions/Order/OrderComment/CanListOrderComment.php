<?php
namespace App\Http\Middleware\Backend\Permissions\Order\OrderComment;


use Closure;
use Illuminate\Support\Facades\Auth;
use App\Exceptions\Backend\Web\ForbiddenException;

class CanListOrderComment
{
    public function handle($request, Closure $next)
    {
        if (!\Auth::user()->ability('sadmin', 'order-comment-list')) {
            throw new ForbiddenException();
        }

        return $next($request);
    }
}