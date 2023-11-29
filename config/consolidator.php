<?php
/**
 * Created by PhpStorm.
 * User: F_Kosimov
 * Date: 04.07.2018
 * Time: 13:33
 */

return [
    'server_ips' => ['10.10.2.110', '10.10.2.111', '127.0.0.1', '::1', '192.168.6.129'],
    'server_login' => env('CONSOLIDATOR_LOGIN', '06092018'),
    'server_secret_key' => env('CONSOLIDATOR_SECRET_KEY', '8JW2Kuo0X6N6JQEsyU0Ji2HTP7j6GcLML1xiPYNVUjLyYRqDn50XAsQ2MVHZIXrBwd3eaN1hdFYDdlwoOPZlQ4kO4LxgZIbIJHdY'),
    'sberbank_login' => env('SBERBANK_LOGIN', '12122019'),
    'sberbank_secret_key' => env('SBERBANK_SECRET_KEY', '85F42a906c12C3F570Bf2Aba286F9c0f7214EFaE5f00f04Ac5727445c103C012fb6F7d436279859144e93415eEb4aE893b9d319F3da49479d0E25a94'),
    'default_http_status' => 200,
    'request_method' => 'get',
    'result_array' => [
        'status' => 1,
        'msg' => '403 Forbidden.'
    ],
    'checkArray' => [
        'type' => null,
        'provid' => null,
        'contractid' => null,
        'date' => null,
        'key' => null,
        'prove_num' => null
    ],
    'payArray' => [
        'type' => null,
        'provid' => null,
        'contractid' => null,
        'date' => null,
        'key' => null,
        'tranzid' => null,
        'summa' => null
    ],
    'messages' => [
        "1" => '\nВнимание! Если вы не идентифицированный пользователь, \nто остаток на вашем счету не должен превышать 1000 сомони, \nиначе платеж не будет зачислен.\n',
        "2" => "Запрос принят успешно!\n",
        "aviableValues" => "[!MSISDN!]  [!FIRST_NAME!] [!MIDDLE_NAME!]  [!LAST_NAME!]  [!BALANCE!] [!LIMIT!] [!CAN_REFIL!]"
    ]
];