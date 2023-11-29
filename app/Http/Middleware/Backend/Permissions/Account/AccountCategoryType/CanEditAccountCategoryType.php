<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 16.07.2019
 * Time: 14:00
 */

namespace App\Http\Middleware\Backend\Permissions\Account\AccountCategoryType;


use App\Exceptions\Backend\Web\ForbiddenException;
use Closure;

class CanEditAccountCategoryType
{
    public function handle($request, Closure $next)
    {
        if (!\Auth::user()->ability('sadmin', 'account-categoryType-edit')) {
            throw new ForbiddenException();
        }

        return $next($request);
    }
}