<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 22.07.2019
 * Time: 10:43
 */

namespace App\Http\Middleware\Backend\Permissions\DwhRule;


use App\Exceptions\Backend\Web\ForbiddenException;
use Closure;

class CanDeleteDwhRule
{
    public function handle($request, Closure $next)
    {
        if (!\Auth::user()->ability('sadmin', 'dwhRule-delete')) {
            throw new ForbiddenException();
        }

        return $next($request);
    }
}