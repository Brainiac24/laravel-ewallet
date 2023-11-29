<?php


namespace App\Http\Middleware\Backend\Permissions\FileManager;


use App\Exceptions\Backend\Web\ForbiddenException;
use Closure;

class CanDeleteFileManager
{
    public function handle($request, Closure $next)
    {
        if (!\Auth::user()->ability('sadmin', 'FileManager-delete')) {
            throw new ForbiddenException();
        }

        return $next($request);
    }
}