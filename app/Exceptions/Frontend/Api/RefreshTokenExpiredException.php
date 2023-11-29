<?php
/**
 * Created by PhpStorm.
 * User: K_Hakimboev
 * Date: 12.07.2018
 * Time: 16:50
 */

namespace App\Exceptions\Frontend\Api;


use App\Services\Common\Helpers\HttpStatusCode;

class RefreshTokenExpiredException extends BaseException
{
    protected function getStatusCode()
    {
        return HttpStatusCode::TOKEN_REFRESH_EXPIRED;
    }

    protected function getComment()
    {
        return trans('auth.token_expired');
    }

}