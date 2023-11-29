<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 08.04.2019
 * Time: 9:28
 */

namespace App\Http\Middleware\Backend\Permissions\Account\AccountStatus;


use App\Exceptions\Backend\Web\ForbiddenException;
use Closure;

class CanListAccountStatus
{
    public function handle($request, Closure $next)
    {
        if (!\Auth::user()->ability('sadmin', 'account-status-list')) {
            throw new ForbiddenException();
        }

        return $next($request);
    }
}