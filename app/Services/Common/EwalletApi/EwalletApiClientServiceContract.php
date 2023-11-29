<?php
/**
 * Created by PhpStorm.
 * User: Dilshod Mamadjonov
 * Date: 10.08.2020
 * Time: 11:28
 */

namespace App\Services\Common\EwalletApi;


interface EwalletApiClientServiceContract
{
    /** @return \GuzzleHttp\Client */
    public function getHttpClient();
}