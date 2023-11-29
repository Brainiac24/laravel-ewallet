<?php
/**
 * Created by PhpStorm.
 * User: Ladmin
 * Date: 11.10.2019
 * Time: 15:10
 */

namespace App\Http\Middleware\Backend\Permissions\Service\ServiceOtpLimit;


use App\Exceptions\Backend\Web\ForbiddenException;
use Closure;

class CanShowServiceOtpLimit
{
    public function handle($request, Closure $next)
    {
        if (!\Auth::user()->ability('sadmin','service-otp-limit-show')) {
            throw new ForbiddenException();
        }

        return $next($request);
    }
}