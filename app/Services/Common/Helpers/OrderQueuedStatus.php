<?php
/**
 * Created by PhpStorm.
 * User: K_Hakimboev
 * Date: 16.10.2018
 * Time: 11:38
 */

namespace App\Services\Common\Helpers;


class OrderQueuedStatus
{
    const NOT_SEND = 0;
    const ERROR_SEND = 1;
    const SENT = 2;
    const MUST_CONTINUE = -1;
}