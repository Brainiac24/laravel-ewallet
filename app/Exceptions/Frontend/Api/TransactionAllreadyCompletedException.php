<?php
/**
 * Created by PhpStorm.
 * User: K_Hakimboev
 * Date: 12.07.2018
 * Time: 16:50
 */

namespace App\Exceptions\Frontend\Api;


use App\Services\Common\Helpers\HttpStatusCode;

class TransactionAllreadyCompletedException extends BaseException
{
    protected function getStatusCode()
    {
        return HttpStatusCode::DUPLICATE_REQUEST;
    }

    protected function getComment()
    {
        //return empty($this->getMessage()) ? trans('auth.logic_error') : $this->getMessage();
    }

}