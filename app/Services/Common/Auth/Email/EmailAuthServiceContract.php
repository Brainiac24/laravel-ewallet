<?php
/**
 * Created by PhpStorm.
 * User: K_Hakimboev
 * Date: 11.07.2018
 * Time: 16:42
 */

namespace App\Services\Common\Auth\Email;


interface EmailAuthServiceContract
{
    public function register(string $email): bool;

    public function registerConfirm(string $token, string $hashCode): bool;
}