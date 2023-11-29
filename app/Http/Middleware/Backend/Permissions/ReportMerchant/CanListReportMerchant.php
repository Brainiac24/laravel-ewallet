<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 18.03.2019
 * Time: 13:20
 */

namespace App\Http\Middleware\Backend\Permissions\ReportMerchant;


use App\Exceptions\Backend\Web\ForbiddenException;
use Closure;

class CanListReportMerchant
{
    /**
     * @param $request
     * @param Closure $next
     * @return mixed
     * @throws ForbiddenException
     */
    public function handle($request, Closure $next)
    {
        if (!\Auth::user()->ability('sadmin', 'reportMerchant-list')) {
            throw new ForbiddenException();
        }

        return $next($request);
    }
}