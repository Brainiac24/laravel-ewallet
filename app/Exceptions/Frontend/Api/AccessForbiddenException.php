<?php
/**
 * Created by PhpStorm.
 * User: K_Hakimboev
 * Date: 12.07.2018
 * Time: 16:50
 */

namespace App\Exceptions\Frontend\Api;


use App\Services\Common\Helpers\HttpStatusCode;

class AccessForbiddenException extends BaseException
{
    protected function getStatusCode()
    {
        return HttpStatusCode::FORBIDDEN;
    }

    protected function getComment()
    {
        return empty($this->getMessage()) ? trans('auth.access_forbidden') : $this->getMessage();
    }

}