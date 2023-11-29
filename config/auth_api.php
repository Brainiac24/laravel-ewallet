<?php
/**
 * Created by PhpStorm.
 * User: K_Hakimboev
 * Date: 12.07.2018
 * Time: 10:07
 */

return [

    /*
     * время временного токена(во время аутентификации) в минутах
     */
    'ttl_temporary_token' => 6,

    /*
     * время основного токена в минутах
     */
    'ttl_access_token' => 17,

    /*
     * время refresh токена в минутах
     */
    'ttl_refresh_token' => 46080,

    /*
     * секретный ключ, используется для генерации сигнатуры
     */
    'jwt_key' => 'sAhMbG8LmWguC}--%(?33?kU7GY%kdtWHCH(zADn86h=#sr',

    'issuer' => 'eskhata.com',

    'android_key' => 'oTU*MC#tMCnOMslbq#oKQzdvR6qpZKGP',

    'ios_key' => '4gNcUIMEEAB4xaVER@%J*HSLq@XhOb!6',

    'pin' => [
        'confirm_try_count' => 3,
        'min_length' => 0,
        'max_length' => 0,
        'timeout_to_enter_pin' => 300, //в секундах,в течении этого времени должен вводиться код. Должен быть больше timeout_confirm_code. Учитывается по колонке время отправки смс кода(sms_code_sent_at)
        'change_try_count' => 5, // после исчерпание временно запрещается смена pin кода
        'interval_lock' => 30, // время(в минутах) блокировки после истечения confirm_try_count, т.е. ввод смены pin кода будет временно блокировано
    ],

    'phone' => [
        'country_codes' => ['992'],
        'operator_codes' => ['92','50','55','77', '93', '98', '918','90','88','91'],
    ],

    'sms' => [
        'min_value' => 10,
        'max_value' => 9999,
        'length' => 4,
        'waiting_to_retry_send' => 60, //в секундах ожидание до повторной отправки смс кода
        'timeout_confirm_code' => 240,// в секундах
        'confirm_try_count' => 3, // после исчерпание юзер временно блокируется
        //'limit_sms_code_sent_count' => 10, // лимит на отправки смс кода для подтверждений, после исчерпание юзер временно блокируется
        'interval_lock' => 10, // интервал(в минутах) для блокировки, формула (lock*count_locked)
        'lock_limit' => 3, //количество временных блокировок, после которого пользователь полностью блокируется
    ],

    'email' => [
        'min_value' => 100,
        'max_value' => 99999,
        'length' => 5,
        'timeout_to_enter_pin' => 360, //в секундах, должен быть больше timeout_confirm_code. Учитывается по колонке время отправки кода на почту
        'waiting_to_retry_send' => 60, //в секундах ожидание до повторной отправки смс кода
        'timeout_confirm_code' => 300,//в секундах
        'confirm_try_count' => 5, // после исчерпание временно запрещается ввод почты
        'interval_lock' => 15, // время блокировки(в минутах) после истечения confirm_try_count, т.е. ввод почты будет вренменно блокировано
    ]


];