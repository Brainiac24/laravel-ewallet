<?php
/**
 * Created by PhpStorm.
 * User: F_Kosimov
 * Date: 04.07.2018
 * Time: 16:42
 */

return [
    'smsRequestURL' => env('QUEUE_TRANSPORT_URL') . '/api/v1/exchange',
    'smsRequestMethod' => 'POST',
    'smsRequestURLv2' => env('QUEUE_TRANSPORT_URL_2') . '/api/v1/exchange',
    'queue_callback_url' => env('QUEUE_CALLBACK_URL').'/api/v2/callback/continue_process',
    'asp_callback_url' => env('QUEUE_CALLBACK_URL').'/api/v2/callback/queue',
    'asp_callback_base_url' => env('QUEUE_CALLBACK_URL'),
    'key' => env('QUEUE_TRANSPORT_KEY', 'eC4_lB3+bB4@cC7$eK1@gB1$cC5*eO'),
    'sms' => [
        'min_value' => 10,
        'max_value' => 9999,
        'length' => 4,
        'waiting_to_retry_send' => 60, //в секундах ожидание до повторной отправки смс кода
        'timeout_confirm_code' => 240,// в секундах
        'confirm_try_count' => 3, // после исчерпание юзер временно блокируется
        //'limit_sms_code_sent_count' => 10, // лимит на отправки смс кода для подтверждений, после исчерпание юзер временно блокируется
        'interval_lock' => 30, // интервал(в минутах) для блокировки, формула (lock*count_locked)
        'lock_limit' => 3, //количество временных блокировок, после которого пользователь полностью блокируется
    ],
];