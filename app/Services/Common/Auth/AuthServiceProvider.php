<?php
/**
 * Created by PhpStorm.
 * User: K_Hakimboev
 * Date: 12.07.2018
 * Time: 10:30
 */

namespace App\Services\Common\Auth;

use App\Services\Common\Auth\Email\EmailAuthService;
use App\Services\Common\Auth\Email\EmailAuthServiceContract;
use App\Services\Common\Auth\Phone\PhoneAuthService;
use App\Services\Common\Auth\Phone\PhoneAuthServiceContract;
use App\Services\Common\Auth\Pin\PinAuthService;
use App\Services\Common\Auth\Pin\PinAuthServiceContract;
use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{

    public function boot()
    {

    }

    public function register()
    {
        $this->app->bind(PhoneAuthServiceContract::class, PhoneAuthService::class);
        $this->app->bind(PinAuthServiceContract::class, PinAuthService::class);
        $this->app->bind(EmailAuthServiceContract::class, EmailAuthService::class);
    }
}