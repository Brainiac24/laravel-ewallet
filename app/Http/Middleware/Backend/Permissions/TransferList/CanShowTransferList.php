<?php
/**
 * Created by PhpStorm.
 * User: Ladmin
 * Date: 29.08.2019
 * Time: 15:45
 */

namespace App\Http\Middleware\Backend\Permissions\TransferList;


use App\Exceptions\Backend\Web\ForbiddenException;
use Closure;

class CanShowTransferList
{
    public function handle($request, Closure $next)
    {
        if (!\Auth::user()->ability('sadmin','transferList-show')) {
            throw new ForbiddenException();
        }

        return $next($request);
    }
}