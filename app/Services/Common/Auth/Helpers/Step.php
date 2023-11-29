<?php
/**
 * Created by PhpStorm.
 * User: K_Hakimboev
 * Date: 12.07.2018
 * Time: 15:33
 */

namespace App\Services\Common\Auth\Helpers;


class Step
{
    //const HELLO = 1;
    const REGISTER_PHONE = 2;
    const REGISTER_CONFIRM_PHONE = 3;
    const REGISTER_PIN = 4;
    const AUTH_PIN = 5;
    const RESET_CONFIRM_PIN = 6;
    const RESET_REGISTER_PIN = 7;
}