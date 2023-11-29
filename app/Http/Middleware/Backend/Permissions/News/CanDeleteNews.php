<?php
/**
 * Created by PhpStorm.
 * User: Ladmin
 * Date: 27.09.2019
 * Time: 11:44
 */

namespace App\Http\Middleware\Backend\Permissions\News;


use App\Exceptions\Backend\Web\ForbiddenException;
use Closure;

class CanDeleteNews
{
    public function handle($request, Closure $next)
    {
        if (!\Auth::user()->ability('sadmin', 'news-delete')) {
            throw new ForbiddenException();
        }

        return $next($request);
    }
}