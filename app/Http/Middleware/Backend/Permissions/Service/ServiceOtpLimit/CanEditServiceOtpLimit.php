<?php
/**
 * Created by PhpStorm.
 * User: Ladmin
 * Date: 11.10.2019
 * Time: 15:09
 */

namespace App\Http\Middleware\Backend\Permissions\Service\ServiceOtpLimit;


use App\Exceptions\Backend\Web\ForbiddenException;
use Closure;

class CanEditServiceOtpLimit
{
    public function handle($request, Closure $next)
    {
        if (!\Auth::user()->ability('sadmin','service-otp-limit-edit')) {
            throw new ForbiddenException();
        }

        return $next($request);
    }
}