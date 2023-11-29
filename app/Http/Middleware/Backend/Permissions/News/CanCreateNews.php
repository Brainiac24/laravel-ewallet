<?php
/**
 * Created by PhpStorm.
 * User: Ladmin
 * Date: 27.09.2019
 * Time: 11:43
 */

namespace App\Http\Middleware\Backend\Permissions\News;


use App\Exceptions\Backend\Web\ForbiddenException;
use Closure;

class CanCreateNews
{
    public function handle($request, Closure $next)
    {
        if (!\Auth::user()->ability('sadmin', 'news-create')) {
            throw new ForbiddenException();
        }

        return $next($request);
    }
}