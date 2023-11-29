<?php
/**
 * Created by PhpStorm.
 * User: Ladmin
 * Date: 29.08.2019
 * Time: 14:46
 */

namespace App\Http\Middleware\Backend\Permissions\Transaction\TransactionSyncStatus;


use App\Exceptions\Backend\Web\ForbiddenException;
use Closure;

class CanListTransactionSyncStatus
{
    public function handle($request, Closure $next)
    {
        if (!\Auth::user()->ability('sadmin', 'transaction-sync-status-list')) {
            throw new ForbiddenException();
        }

        return $next($request);
    }
}