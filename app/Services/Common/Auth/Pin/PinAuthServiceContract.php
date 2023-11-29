<?php
/**
 * Created by PhpStorm.
 * User: K_Hakimboev
 * Date: 11.07.2018
 * Time: 16:42
 */

namespace App\Services\Common\Auth\Pin;


use App\Services\Common\Auth\AuthEntity;

interface PinAuthServiceContract
{
    public function register(string $token, string $pin): AuthEntity;

    public function auth(string $token, string $hashPin): AuthEntity;

    public function reset(string $token): AuthEntity;

    public function resetConfirm(string $token, string $hashCode): AuthEntity;

    public function resetRegister(string $token, string $pin): AuthEntity;

    public function change(string $token, string $oldHashPin, string $newPin): bool;
}