<?php


namespace App\Http\Middleware\Backend\Permissions\FAQ\FAQQuestion;


use App\Exceptions\Backend\Web\ForbiddenException;
use Closure;

class CanListFAQQuestion
{
    public function handle($request, Closure $next)
    {
        if (!\Auth::user()->ability('sadmin', 'FAQQuestion-list')) {
            throw new ForbiddenException();
        }

        return $next($request);
    }
}