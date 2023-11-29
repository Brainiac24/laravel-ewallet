<?php
/**
 * Created by PhpStorm.
 * User: K_Hakimboev
 * Date: 12.07.2018
 * Time: 10:22
 */

namespace App\Services\Common\Auth\Token;


interface TokenContract
{
    public function makeTemporaryToken();
}