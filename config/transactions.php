<?php
/**
 * Created by PhpStorm.
 * User: F_Kosimov
 * Date: 04.07.2018
 * Time: 16:42
 */

return [
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
    'transaction_statuses' => [
        \App\Services\Common\Helpers\TransactionStatus::new,
        \App\Services\Common\Helpers\TransactionStatus::BLOCKED,
        \App\Services\Common\Helpers\TransactionStatus::BLOCK_REJECTED,
        \App\Services\Common\Helpers\TransactionStatus::BLOCK_UNKNOWN,
        \App\Services\Common\Helpers\TransactionStatus::PAY_IN_PROCESS,
        \App\Services\Common\Helpers\TransactionStatus::PAY_COMPLETED,
        \App\Services\Common\Helpers\TransactionStatus::PAY_REJECTED,
        \App\Services\Common\Helpers\TransactionStatus::PAY_UNKNOWN,
        \App\Services\Common\Helpers\TransactionStatus::CONFIRMED,
        \App\Services\Common\Helpers\TransactionStatus::CONFIRM_UNKNOWN,
        \App\Services\Common\Helpers\TransactionStatus::CANCELED,
        \App\Services\Common\Helpers\TransactionStatus::CANCEL_UNKNOWN,
        \App\Services\Common\Helpers\TransactionStatus::REJECTED,
        \App\Services\Common\Helpers\TransactionStatus::COMPLETED,
    ],
];