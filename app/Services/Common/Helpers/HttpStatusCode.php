<?php
/**
 * Created by PhpStorm.
 * User: K_Hakimboev
 * Date: 12.07.2018
 * Time: 16:55
 */

namespace App\Services\Common\Helpers;


class HttpStatusCode
{
    const OK = 0;
    const UNKNOWN_ERROR = 1;
    const SERVICE_UNAVAILABLE = 2;
    const API_DEPRECATED = 3;
    const RESOURCE_NOT_FOUND = 4;
    const ERROR_AUTH = 5;
    const FORBIDDEN = 6;
    const TOKEN_EXPIRED = 7;
    const TOO_MANY_REQUESTS = 8;
    const NEED_TO_UPGRADE = 9;
    const TIMEOUT = 10;
    const WAITING = 11;
    const BAD_REQUEST = 12;
    const DUPLICATE_REQUEST = 13;
    const LIMIT_EXCEEDED = 14;
    const USER_TEMPORARILY_BLOCKED = 15;
    const TOKEN_REFRESH_EXPIRED = 16;
    const UNHANDLED_EXCEPTION = 17;

}