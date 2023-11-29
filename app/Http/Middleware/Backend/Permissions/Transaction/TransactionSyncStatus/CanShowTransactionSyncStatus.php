<?php
/**
 * Created by PhpStorm.
 * User: Ladmin
 * Date: 29.08.2019
 * Time: 14:47
 */

namespace App\Http\Middleware\Backend\Permissions\Transaction\TransactionSyncStatus;


use App\Exceptions\Backend\Web\ForbiddenException;
use Closure;

class CanShowTransactionSyncStatus
{
    public function handle($request, Closure $next)
    {
        if (!\Auth::user()->ability('sadmin', 'transaction-sync-status-show')) {
            throw new ForbiddenException();
        }

        return $next($request);
    }
}