<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 16.07.2019
 * Time: 14:03
 */

namespace App\Http\Middleware\Backend\Permissions\Account\AccountCategoryType;


use App\Exceptions\Backend\Web\ForbiddenException;
use Closure;

class CanShowAccountCategoryType
{
    public function handle($request, Closure $next)
    {
        if (!\Auth::user()->ability('sadmin', 'account-categoryType-show')) {
            throw new ForbiddenException();
        }

        return $next($request);
    }
}