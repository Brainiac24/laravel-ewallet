<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 12.03.2019
 * Time: 11:24
 */

namespace App\Http\Middleware\Backend\Permissions\LicenseAgreement;
use App\Exceptions\Backend\Web\ForbiddenException;
use Closure;

class CanShowLicense
{
    /**
     * @param $request
     * @param Closure $next
     * @return mixed
     * @throws ForbiddenException
     */
    public function handle($request, Closure $next)
    {
        if (!\Auth::user()->ability('sadmin','license-show')) {
            throw new ForbiddenException();
        }

        return $next($request);
    }
}