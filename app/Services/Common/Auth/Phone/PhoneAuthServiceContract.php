<?php
/**
 * Created by PhpStorm.
 * User: K_Hakimboev
 * Date: 11.07.2018
 * Time: 16:42
 */

namespace App\Services\Common\Auth\Phone;


use App\Services\Common\Auth\AuthEntity;

interface PhoneAuthServiceContract
{
    public function register(string $token, string $msisdn): string;

    public function registerConfirm(string $token, string $hashCode): AuthEntity;
}