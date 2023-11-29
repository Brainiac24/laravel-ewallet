<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 08.04.2019
 * Time: 9:27
 */

namespace App\Http\Middleware\Backend\Permissions\Account\AccountStatus;


use App\Exceptions\Backend\Web\ForbiddenException;
use Closure;

class CanEditAccountStatus
{
    public function handle($request, Closure $next)
    {
        if (!\Auth::user()->ability('sadmin', 'account-status-edit')) {
            throw new ForbiddenException();
        }

        return $next($request);
    }
}