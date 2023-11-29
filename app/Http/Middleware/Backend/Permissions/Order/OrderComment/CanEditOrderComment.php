<?php
namespace App\Http\Middleware\Backend\Permissions\Order\OrderComment;


use Closure;
use Illuminate\Support\Facades\Auth;
use App\Exceptions\Backend\Web\ForbiddenException;

class CanEditOrderComment
{
    public function handle($request, Closure $next)
    {
        if (!\Auth::user()->ability('sadmin', 'order-comment-edit')) {
            throw new ForbiddenException();
        }

        return $next($request);
    }
}