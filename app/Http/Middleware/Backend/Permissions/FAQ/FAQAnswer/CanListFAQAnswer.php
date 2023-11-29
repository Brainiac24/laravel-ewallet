<?php


namespace App\Http\Middleware\Backend\Permissions\FAQ\FAQAnswer;


use App\Exceptions\Backend\Web\ForbiddenException;
use Closure;

class CanListFAQAnswer
{
    public function handle($request, Closure $next)
    {
        if (!\Auth::user()->ability('sadmin', 'FAQAnswer-list')) {
            throw new ForbiddenException();
        }

        return $next($request);
    }
}