<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 29.07.2019
 * Time: 14:24
 */

namespace App\Http\Middleware\Backend\Permissions\CategoryType;


use App\Exceptions\Backend\Web\ForbiddenException;
use Closure;

class CanManageCategoryType
{
    public function handle($request, Closure $next)
    {
        if (!\Auth::user()->ability('sadmin','categoryType')) {
            throw new ForbiddenException();
        }

        return $next($request);
    }
}