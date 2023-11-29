<?php


namespace App\Http\Middleware\Backend\Permissions\FAQ\FAQAnswer;


use App\Exceptions\Backend\Web\ForbiddenException;
use Closure;

class CanShowFAQAnswer
{
    public function handle($request, Closure $next)
    {
        if (!\Auth::user()->ability('sadmin', 'FAQAnswer-show')) {
            throw new ForbiddenException();
        }

        return $next($request);
    }
}