<?php

namespace App\Repositories\Backend\SplashScreen;

interface SplashScreenRepositoryContract
{
    public function updateValue($value);

    public function listAll();

    public function saveImage($image);

    public function getOneSplashScreen();
}