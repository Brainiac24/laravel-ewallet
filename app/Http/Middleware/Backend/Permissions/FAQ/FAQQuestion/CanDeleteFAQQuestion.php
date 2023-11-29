<?php


namespace App\Http\Middleware\Backend\Permissions\FAQ\FAQQuestion;


use App\Exceptions\Backend\Web\ForbiddenException;
use Closure;

class CanDeleteFAQQuestion
{
    public function handle($request, Closure $next)
    {
        if (!\Auth::user()->ability('sadmin', 'FAQQuestion-delete')) {
            throw new ForbiddenException();
        }

        return $next($request);
    }
}