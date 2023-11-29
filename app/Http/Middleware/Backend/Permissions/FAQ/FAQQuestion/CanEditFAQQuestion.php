<?php


namespace App\Http\Middleware\Backend\Permissions\FAQ\FAQQuestion;


use App\Exceptions\Backend\Web\ForbiddenException;
use Closure;

class CanEditFAQQuestion
{
    public function handle($request, Closure $next)
    {
        if (!\Auth::user()->ability('sadmin', 'FAQQuestion-edit')) {
            throw new ForbiddenException();
        }

        return $next($request);
    }
}