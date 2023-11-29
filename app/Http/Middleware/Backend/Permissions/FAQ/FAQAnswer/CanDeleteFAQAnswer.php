<?php


namespace App\Http\Middleware\Backend\Permissions\FAQ\FAQAnswer;


use App\Exceptions\Backend\Web\ForbiddenException;
use Closure;

class CanDeleteFAQAnswer
{
    public function handle($request, Closure $next)
    {
        if (!\Auth::user()->ability('sadmin', 'FAQAnswer-delete')) {
            throw new ForbiddenException();
        }

        return $next($request);
    }
}