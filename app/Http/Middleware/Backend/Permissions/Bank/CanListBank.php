<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 22.07.2019
 * Time: 10:45
 */

namespace App\Http\Middleware\Backend\Permissions\Bank;


use App\Exceptions\Backend\Web\ForbiddenException;
use Closure;

class CanListBank
{
    public function handle($request, Closure $next)
    {
        if (!\Auth::user()->ability('sadmin', 'bank-list')) {
            throw new ForbiddenException();
        }

        return $next($request);
    }
}