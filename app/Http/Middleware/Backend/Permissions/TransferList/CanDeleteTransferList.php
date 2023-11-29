<?php
/**
 * Created by PhpStorm.
 * User: Ladmin
 * Date: 29.08.2019
 * Time: 17:05
 */

namespace App\Http\Middleware\Backend\Permissions\TransferList;


use App\Exceptions\Backend\Web\ForbiddenException;
use Closure;

class CanDeleteTransferList
{
    public function handle($request, Closure $next)
    {
        if (!\Auth::user()->ability('sadmin','transferList-delete')) {
            throw new ForbiddenException();
        }

        return $next($request);
    }
}