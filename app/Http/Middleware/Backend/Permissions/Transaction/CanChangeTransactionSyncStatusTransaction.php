<?php
/**
 * Created by PhpStorm.
 * User: Ladmin
 * Date: 19.11.2019
 * Time: 16:22
 */

namespace App\Http\Middleware\Backend\Permissions\Transaction;


use App\Exceptions\Backend\Web\ForbiddenException;
use Closure;

class CanChangeTransactionSyncStatusTransaction
{
    public function handle($request, Closure $next)
    {
        if (!\Auth::user()->ability(null, 'transaction-changeTransactionSyncStatus')) {
            throw new ForbiddenException();
        }

        return $next($request);
    }
}