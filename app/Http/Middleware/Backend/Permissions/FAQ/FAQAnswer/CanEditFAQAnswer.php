<?php


namespace App\Http\Middleware\Backend\Permissions\FAQ\FAQAnswer;


use App\Exceptions\Backend\Web\ForbiddenException;
use Closure;

class CanEditFAQAnswer
{
    public function handle($request, Closure $next)
    {
        if (!\Auth::user()->ability('sadmin', 'FAQAnswer-edit')) {
            throw new ForbiddenException();
        }

        return $next($request);
    }
}