<?php
/**
 * Created by PhpStorm.
 * User: K_Hakimboev
 * Date: 12.07.2018
 * Time: 16:50
 */

namespace App\Exceptions\Frontend\Api;


use App\Services\Common\Helpers\HttpStatusCode;

class ResourceNotFoundException extends BaseException
{
    protected function getStatusCode()
    {
        return HttpStatusCode::RESOURCE_NOT_FOUND;
    }

    protected function getComment()
    {
        return empty($this->getMessage()) ? trans('auth.resource_not_found') : $this->getMessage();
    }

}