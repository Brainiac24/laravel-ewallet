<?php
/**
 * Created by PhpStorm.
 * User: Dilshod Mamadjonov
 * Date: 27.08.2020
 * Time: 10:21
 */

return [
    'GuzzleClientConfig' => [
        'base_uri' =>  env('QUEUE_CALLBACK_URL'),
        'timeout'  => 50,
    ],
    'public_url' => env("EWALLETAPI_PUBLIC_URL")
];