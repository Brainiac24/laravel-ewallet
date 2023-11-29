<?php
/**
 * Created by PhpStorm.
 * User: Ladmin
 * Date: 29.08.2019
 * Time: 13:28
 */

namespace App\Http\Middleware\Backend\Permissions\Transaction\TransactionStatusGroup;


use App\Exceptions\Backend\Web\ForbiddenException;
use Closure;

class CanShowTransactionStatusGroup
{
    public function handle($request, Closure $next)
    {
        if (!\Auth::user()->ability('sadmin', 'transaction-status-group-show')) {
            throw new ForbiddenException();
        }

        return $next($request);
    }
}